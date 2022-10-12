<?php


namespace App\SMS\Services;


use App\Models\SMS\Form5\Deliveries;
use App\Models\SMS\WeeklyReports;
use App\Swep\Helpers\Arrays;
use App\Swep\Helpers\Helper;
use function Doctrine\Common\Cache\Psr6\get;

class WeeklyReportService
{
    public function findWeeklyReportBySlug($slug){
        $wr = WeeklyReports::query()->with(['form1','form2'])->where('slug','=',$slug)->first();
        if(empty($wr)){
            return null;
        }
        return $wr;
    }

    public function isNotSubmitted($slug){
        $wr = $this->findWeeklyReportBySlug($slug);
        if($wr->status == 1){
            abort(503,'This weekly report has already been submitted. You cannot perform any actions other than viewing and printing.');
        }
        return true;
    }


    public function computation($slug, $get = null){

        $weekly_report = $this->findWeeklyReportBySlug($slug);
        $valuesStructure = [];
        foreach (Arrays::sugarClasses() as $sugarClass){
            $valuesStructure[$sugarClass] = [
                'current' => null,
                'prev' => null,
            ];
        }

        $toDate =  $weekly_report->toDateForm1();

        //MANUFACTURED
        $formArray['manufactured']['current'] = $get=='toDate' ? $toDate->manufactured : $weekly_report->form1->manufactured ?? null;
        $formArray['manufactured']['prev'] = $get=='toDate' ? $toDate->prev_manufactured  : $weekly_report->form1->prev_manufactured ?? null;

        //ISSUANCES
        $formArray['issuances'] = $valuesStructure;
        if(!empty($weekly_report->form1)){
            foreach (Arrays::sugarClasses() as $sugarClass){
                $formArray['issuances'][$sugarClass]['current'] = $get=='toDate' ? $toDate->$sugarClass :  $weekly_report->form1->$sugarClass;
                $formArray['issuances'][$sugarClass]['prev'] = $get=='toDate'  ? $toDate->{'prev_'.$sugarClass} : $weekly_report->form1->{'prev_'.$sugarClass};
            }
        }

        $formArray['issuancesTotal']['current'] = array_sum(array_column($formArray['issuances'],'current'));
        $formArray['issuancesTotal']['prev'] = array_sum(array_column($formArray['issuances'],'prev'));
        $formArray['withdrawals'] = $valuesStructure;
        $formArray['forRefining'] = $valuesStructure;


        //WITHDRAWALS
        if($get == 'toDate'){
            $deliveries = Deliveries::query()
                ->selectRaw('weekly_report_slug,trader, refining,sugar_class, sum(qty) as currentTotal, sum(qty_prev) as prevTotal, weekly_reports.*')
                ->leftJoin('weekly_reports','weekly_reports.slug','=','form5_deliveries.weekly_report_slug')
                ->where('crop_year','=',$weekly_report->crop_year)
                ->where('mill_code','=',$weekly_report->mill_code)
                ->where('report_no','<=',$weekly_report->report_no)
                ->groupBy('refining','sugar_class')
                ->orderBy('sugar_class','asc')
                ->get();
        }else{
            $deliveries = $weekly_report->form5Deliveries()
                ->selectRaw('refining, sugar_class,sum(qty) as currentTotal, sum(qty_prev) as prevTotal')
                ->groupBy('refining','sugar_class')
                ->orderBy('sugar_class','asc')
                ->get();
        }
        if(!empty($deliveries)){
            foreach ($deliveries as $delivery){
                if($delivery->refining == null){
                    $key = 'withdrawals';
                }else{
                    $key = 'forRefining';
                }
                $formArray[$key][$delivery->sugar_class]['current'] = $delivery->currentTotal;
                $formArray[$key][$delivery->sugar_class]['prev'] = $delivery->prevTotal;
            }
        }


        $formArray['withdrawalsTotal']['current'] = array_sum(array_column($formArray['withdrawals'],'current'));
        $formArray['withdrawalsTotal']['prev'] = array_sum(array_column($formArray['withdrawals'],'prev'));
        $formArray['forRefiningTotal']['current'] = array_sum(array_column($formArray['forRefining'],'current'));
        $formArray['forRefiningTotal']['prev'] = array_sum(array_column($formArray['forRefining'],'prev'));
        $formArray['balances']= $valuesStructure;

        //BALANCES
        foreach ($formArray['issuances'] as $k => $v){
            $formArray['balances'][$k]['current'] = $formArray['issuances'][$k]['current'] - $formArray['withdrawals'][$k]['current'] - $formArray['forRefining'][$k]['current'];
            $formArray['balances'][$k]['prev'] = $formArray['issuances'][$k]['prev'] - $formArray['withdrawals'][$k]['prev'] - $formArray['forRefining'][$k]['prev'];
        }
        $formArray['balancesTotal']['current'] = array_sum(array_column($formArray['balances'],'current'));
        $formArray['balancesTotal']['prev'] = array_sum(array_column($formArray['balances'],'prev'));


        //UNQUEDANNED = MANUFACTURED - ISSUANCES
        $formArray['unquedanned'] = [
            'current' => $formArray['manufactured']['current'] - array_sum(array_column($formArray['issuances'],'current')),
            'prev' => $formArray['manufactured']['prev'] - array_sum(array_column($formArray['issuances'],'prev')),
        ];


        //STOCK BALANCE = Manufactured - Withdrawals
        $formArray['stockBalance'] = [
            'current' => $formArray['manufactured']['current'] - $formArray['withdrawalsTotal']['current'] - $formArray['forRefiningTotal']['current'],
            'prev' => $formArray['manufactured']['prev'] - $formArray['withdrawalsTotal']['prev'] - $formArray['forRefiningTotal']['prev'],
        ];

        //TRANSFERS TO REFINERY = Form2 not covered by sro
        $formArray['transfersToRefinery'] = [
            'current' => $weekly_report->form5aIssuancesOfSro()->sum('raw_qty') * 20,
            'prev' => null,
        ];

        //PHYSICAL STOCK = STOCK BALANCE - TRANSFERS TO REFINERY
        $formArray['physicalStock'] = [
            'current' => $formArray['stockBalance']['current'] - $formArray['transfersToRefinery']['current'],
            'prev' => $formArray['stockBalance']['prev'] - $formArray['transfersToRefinery']['prev'],
        ];

        //UNSET EMPTY VALUES
        foreach ($formArray['issuances'] as $key => $value){
            if(empty($value['current']) && empty($value['prev'])){
                unset($formArray['issuances'][$key]);
            }
        }
        foreach ($formArray['withdrawals'] as $key => $value){
            if(empty($value['current']) && empty($value['prev'])){
                unset($formArray['withdrawals'][$key]);
            }
        }
        foreach ($formArray['forRefining'] as $key => $value){
            if(empty($value['current']) && empty($value['prev'])){
                unset($formArray['forRefining'][$key]);
            }
        }
        foreach ($formArray['balances'] as $key => $value){
            if(empty($value['current']) && empty($value['prev'])){
                unset($formArray['balances'][$key]);
            }
        }


        return $formArray;
        echo print('<pre>'.print_r($formArray,true).'</pre>');
        die();
        //TRANSFERS TO REFINERY = FORM2 Not covered by SRO * 20

        //PHYSICAL STOCK = STOCK BALANCE - TRANSFERS TO REF;
    }

    private function makeCurrentPrev($current = null, $previous = null){
        return [
            'current' => $current,
            'prev' => $previous,
        ];
    }

    public function form2Computation($slug,$form2Array = null){
        $formArray = [];
        $weekly_report = $this->findWeeklyReportBySlug($slug);
        $cp = ['current'=>null,'prev'=>null];
        //carryOver
        $formArray['carryOver'] = $this->makeCurrentPrev($weekly_report->form2->carryOver ?? null, $weekly_report->form2->prev_carryOver ?? null);
        //receipts
        $formArray['receipts'] = [
            'coveredBySro' => $this->makeCurrentPrev($weekly_report->form2->coveredBySro ?? null, $weekly_report->form2->prev_coveredBySro ?? null),
            'notCoveredBySro' => $this->makeCurrentPrev($weekly_report->form2->notCoveredBySro ?? null, $weekly_report->form2->prev_notCoveredBySro ?? null),
            'otherMills' => $this->makeCurrentPrev($weekly_report->form2->otherMills ?? null, $weekly_report->form2->prev_otherMills ?? null),
            'imported' => $this->makeCurrentPrev($weekly_report->form2->imported ?? null, $weekly_report->form2->prev_imported ?? null),
        ];
        $formArray['totalReceipts']['current'] = array_sum(array_column($formArray['receipts'],'current'));
        $formArray['totalReceipts']['prev'] = array_sum(array_column($formArray['receipts'],'prev'));

        $formArray['melted'] = $this->makeCurrentPrev($weekly_report->form2->melted ?? null, $weekly_report->form2->prev_melted ?? null);;
        $formArray['rawWithdrawals'] = $this->makeCurrentPrev($weekly_report->form2->rawWithdrawals ?? null, $weekly_report->form2->prev_rawWithdrawals ?? null);;
        $formArray['rawBalance']['current'] = $formArray['totalReceipts']['current'] - $formArray['melted']['current'] - $formArray['rawWithdrawals']['current'];
        $formArray['rawBalance']['prev'] = $formArray['totalReceipts']['prev'] - $formArray['melted']['prev'] - $formArray['rawWithdrawals']['prev'];


        //production
        $formArray['production'] = [
            'domestic' => $this->makeCurrentPrev($weekly_report->form2->prodDomestic ?? null,$weekly_report->form2->prev_prodDomestic ?? null),
            'imported' => $this->makeCurrentPrev($weekly_report->form2->prodImported ?? null,$weekly_report->form2->prev_prodImported ?? null),
            'returnToProcess' => $this->makeCurrentPrev($weekly_report->form2->prodReturn ?? null,$weekly_report->form2->prev_prodReturn ?? null),
        ];


        //TOTAL REFINED
        $formArray['totalProduction'] = [
            'current' => array_sum(array_column($formArray['production'],'current')),
            'prev' => array_sum(array_column($formArray['production'],'prev')),
        ];

        $formArray['totalRefined'] = [
            'current' => $formArray['production']['domestic']['current'] + $formArray['production']['imported']['current'],
            'prev' => $formArray['production']['domestic']['prev'] + $formArray['production']['imported']['prev'],
        ];
        $formArray['issuances'] = [];
        //ISSUANCES
        $is = $weekly_report->form5aIssuancesOfSro()
            ->selectRaw('consumption, sum(refined_qty) as currentTotal, sum(prev_refined_qty) as prevTotal')
            ->groupBy('consumption')
            ->orderBy('consumption','asc')
            ->get();
        if(!empty($is)){
            foreach ($is as $i){
                $formArray['issuances'][strtolower($i->consumption)]['current'] = $i->currentTotal;
                $formArray['issuances'][strtolower($i->consumption)]['prev'] = $i->prevTotal;

                $formArray['issuances'.ucfirst(strtolower($i->consumption))]['current'] = $i->currentTotal;
                $formArray['issuances'.ucfirst(strtolower($i->consumption))]['prev'] = $i->prevTotal;
            }
        }

        $formArray['issuancesTotal'] = [
            'current' => isset($formArray['issuances']) ? array_sum(array_column($formArray['issuances'],'current')) : null,
            'prev' => isset($formArray['issuances']) ? array_sum(array_column($formArray['issuances'],'prev')) : null,
        ];

        $formArray['withdrawals'] = [];
        //WITHDRAWALS /DELIVERIES
        $ws = $weekly_report->form5aDeliveries()
            ->selectRaw('consumption, sum(qty_total) as currentTotal')
            ->groupBy('consumption')
            ->orderBy('consumption','asc')
            ->get();
        if(!empty($ws)){
            foreach ($ws as $w){
                $formArray['withdrawals'][strtolower($w->consumption)]['current'] = $w->currentTotal;
                $formArray['withdrawals'][strtolower($w->consumption)]['prev'] = $w->prevTotal;

                $formArray['withdrawals'.ucfirst(strtolower($i->consumption))]['current'] = $i->currentTotal;
                $formArray['withdrawals'.ucfirst(strtolower($i->consumption))]['prev'] = $i->prevTotal;
            }
        }
        $formArray['withdrawals']['total'] = [
            'current' => isset($formArray['withdrawals']) ?  array_sum(array_column($formArray['withdrawals'],'current')) : null,
            'prev' => isset($formArray['withdrawals']) ?  array_sum(array_column($formArray['withdrawals'],'prev')) : null,
        ];
        //STOCK BALANCE = PROD NET - WITHDRAWALS
        $formArray['stockBalance'] = [
            'current' => $formArray['totalProduction']['current'] - $formArray['withdrawals']['total']['current'],
            'prev' => $formArray['totalProduction']['prev'] - $formArray['withdrawals']['total']['prev'],
        ];

        //UNQEUDANNED = PROD NET - ISSUANCES
        $formArray['unquedanned'] = [
            'current' => $formArray['totalProduction']['current'] - $formArray['issuancesTotal']['current'],
            'prev' => $formArray['totalProduction']['prev'] - $formArray['issuancesTotal']['prev'],
        ];
        \Hash::make('dds');
        $formArray['stockOnHand'] = [
            'current' => $formArray['stockBalance']['current'] + $formArray['unquedanned']['current'],
            'prev' => $formArray['stockBalance']['prev'] + $formArray['unquedanned']['prev'],
        ];


        return $formArray;
        print('<pre>'.print_r($formArray,true).'</pre>');
    }

}