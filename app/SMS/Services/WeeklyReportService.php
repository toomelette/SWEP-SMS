<?php


namespace App\SMS\Services;


use App\Models\SMS\Form3\Withdrawals;
use App\Models\SMS\Form5\Deliveries;
use App\Models\SMS\Form5a\IssuancesOfSro;
use App\Models\SMS\SeriesNos;
use App\Models\SMS\Signatories;
use App\Models\SMS\SignatoriesSaved;
use App\Models\SMS\Subsidiaries;
use App\Models\SMS\WeeklyReports;
use App\Models\Warehouses;
use App\Swep\Helpers\Arrays;
use App\Swep\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use function Doctrine\Common\Cache\Psr6\get;

class WeeklyReportService
{
    public function findWeeklyReportBySlug($slug){
        $wr = WeeklyReports::query()->with(['form1','form2', 'form3'])->where('slug','=',$slug)->first();
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


    public function computation($slug, $get = '', $report_no = null){

        $weekly_report = $this->findWeeklyReportBySlug($slug);
        $valuesStructure = [];
        foreach (Arrays::sugarClasses() as $sugarClass){
            $valuesStructure[$sugarClass] = [
                'current' => null,
                'prev' => null,
            ];
        }

        $toDate =  $weekly_report->toDateForm1();


        if($get == 'toDate'){
            $relation = $weekly_report->form1ToDateAsOf($report_no != 0 ? $report_no : $weekly_report->report_no * 1);

        }else{
            $relation = $weekly_report->form1;
        }

        //manufactured
        $formArray['manufactured'] = $this->makeCurrentPrev($relation->manufactured ?? null, $relation->prev_manufactured ?? null);


//        $formArray['manufactured']['current'] = $get=='toDate' ? $toDate->manufactured : $weekly_report->form1->manufactured ?? null;
//        $formArray['manufactured']['prev'] = $get=='toDate' ? $toDate->prev_manufactured  : $weekly_report->form1->prev_manufactured ?? null;


        //ISSUANCES
        $formArray['issuances'] = $valuesStructure;
        if(!empty($weekly_report->form1)){
            foreach (Arrays::sugarClasses() as $sugarClass){
//                $formArray['issuances'][$sugarClass]['current'] = $get=='toDate' ? $toDate->$sugarClass :  $weekly_report->form1->$sugarClass;
//                $formArray['issuances'][$sugarClass]['prev'] = $get=='toDate'  ? $toDate->{'prev_'.$sugarClass} : $weekly_report->form1->{'prev_'.$sugarClass};
                $formArray['issuances'][$sugarClass] = $this->makeCurrentPrev($relation->$sugarClass ?? null, $relation->{'prev_'.$sugarClass} ?? null);
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
                ->where('report_no','<=',$report_no != 0 ? $report_no : $weekly_report->report_no * 1)
                ->where(function($q){
                    $q->where('weekly_reports.status' ,'!=', -1)
                        ->orWhere('weekly_reports.status', '=', null);
                })
                ->groupBy('refining','sugar_class')
                ->orderBy('sugar_class','asc')
                ->get();


        }else{
            $deliveries = $weekly_report->form5Deliveries()
                ->selectRaw('refining, sugar_class,sum(qty) as currentTotal, sum(qty_prev) as prevTotal')
                ->groupBy('refining','sugar_class')
                ->orderBy('sugar_class','asc')
                ->get();
//            dd($deliveries);
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

        $formArray['overallWithdrawal']['current'] = ($formArray['withdrawalsTotal']['current'] ?? 0) + ($formArray['forRefiningTotal']['current'] ?? 0);
        $formArray['overallWithdrawal']['prev'] = ($formArray['withdrawalsTotal']['prev'] ?? 0) + ($formArray['forRefiningTotal']['prev'] ?? 0);

        $formArray['balances']= $valuesStructure;


        //BALANCES
        foreach ($formArray['issuances'] as $k => $v){
            $formArray['balances'][$k]['current'] = $formArray['issuances'][$k]['current'] - $formArray['withdrawals'][$k]['current'] - $formArray['forRefining'][$k]['current'];
            $formArray['balances'][$k]['prev'] = $formArray['issuances'][$k]['prev'] - $formArray['withdrawals'][$k]['prev'] - $formArray['forRefining'][$k]['prev'];
//            $formArray['balances'][$k]['prev'] = $formArray['manufactured']['prev'] - $formArray['withdrawals'][$k]['prev'] - $formArray['forRefining'][$k]['prev'];
        }
        $formArray['balancesTotal']['current'] = array_sum(array_column($formArray['balances'],'current'));
        $formArray['balancesTotal']['prev'] = array_sum(array_column($formArray['balances'],'prev'));


        //UNQUEDANNED = MANUFACTURED - ISSUANCES
        $formArray['unquedanned'] = [
            'current' => $formArray['manufactured']['current'] - array_sum(array_column($formArray['issuances'],'current')),
//            'prev' => $formArray['manufactured']['prev'] - array_sum(array_column($formArray['issuances'],'prev')),
            'prev' => $formArray['issuancesTotal']['prev'] - array_sum(array_column($formArray['issuances'],'prev')),
        ];


        //STOCK BALANCE = Manufactured - Withdrawals
//        $formArray['stockBalance'] = [
//            'current' => $formArray['manufactured']['current'] - $formArray['withdrawalsTotal']['current'] - $formArray['forRefiningTotal']['current'],
////            'prev' => $formArray['manufactured']['prev'] - $formArray['withdrawalsTotal']['prev'] - $formArray['forRefiningTotal']['prev'],
//            'prev' => $formArray['issuancesTotal']['prev'] - $formArray['withdrawalsTotal']['prev'] - $formArray['forRefiningTotal']['prev'],
//        ];
        $formArray['stockBalance'] = [
            'current' => $formArray['balancesTotal']['current'] + $formArray['unquedanned']['current'],
            'prev' => $formArray['balancesTotal']['prev'] + $formArray['unquedanned']['prev'],
        ];

        //TRANSFERS TO REFINERY = Form2 not covered by sro
        if($get == 'toDate'){
            $form2Relation = $weekly_report->form2ToDateAsOf($report_no != 0 ? $report_no : $weekly_report->report_no * 1);
        }else{
            $form2Relation = $weekly_report->form2;
        }
        $formArray['transfersToRefinery'] = $this->makeCurrentPrev($form2Relation->notCoveredBySro ?? null, $form2Relation->prev_notCoveredBySro ?? null);

        //PHYSICAL STOCK = STOCK BALANCE - TRANSFERS TO REFINERY
        $formArray['physicalStock'] = [
            'current' => $formArray['stockBalance']['current'] - $formArray['transfersToRefinery']['current'],
            'prev' => $formArray['stockBalance']['prev'] - $formArray['transfersToRefinery']['prev'],
        ];
        //TONS DUE CANE
        $formArray['tdc']['current'] = $relation->tdc ?? null;
        $formArray['gtcm']['current'] = $relation->gtcm ?? null;
        if(!empty($relation->gtcm) && $relation->gtcm != 0){
            $formArray['lkgtc_gross']['current'] = ($relation->tdc ?? 0) * 20 / $formArray['gtcm']['current'] ;
        }else{
            $formArray['lkgtc_gross']['current'] = 0;
        }

        $formArray['tds']['current'] = $relation->tds ?? null;
        $formArray['egtcm']['current'] = $relation->egtcm ?? null;
        if(!empty($relation->egtcm) && $relation->egtcm != 0){
            $formArray['lkgtc_gross_syrup']['current'] = ($relation->tds ?? 0) * 20 / $formArray['egtcm']['current'] ;
        }else{
            $formArray['lkgtc_gross_syrup']['current'] = 0;
        }

        $formArray['share_planter']['current'] = $relation->share_planter ?? null;
        $formArray['share_miller']['current'] = $relation->share_miller ?? null;


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
        if(!empty($weekly_report->form1)){
            if($weekly_report->form1->gtcm != 0){
                $formArray['fieldsToFill']['lkgtcGross'] = Helper::toNumber($formArray['lkgtc_gross']['current'],4);
            }else{
                $formArray['fieldsToFill']['lkgtcGross'] = 0;
            }

            if($weekly_report->form1->egtcm != 0){
                $formArray['fieldsToFill']['lkgtc_gross_syrup'] = Helper::toNumber($formArray['lkgtc_gross_syrup']['current'],3);
            }else{
                $formArray['fieldsToFill']['lkgtc_gross_syrup'] = 0;
            }
        }else{
            $formArray['fieldsToFill']['lkgtcGross'] = 0;
        }

        if(!empty($weekly_report->form1)){

        }else{
            $formArray['fieldsToFill']['lkgtcGross'] = 0;
        }


        return $formArray;
        echo print('<pre>'.print_r($formArray,true).'</pre>');
        die();

    }

    private function makeCurrentPrev($current = null, $previous = null){
        return [
            'current' => $current,
            'prev' => $previous,
        ];
    }

    public function form2Computation($slug,$get ='' , $report_no = 0){
        $formArray = [];
        $weekly_report = $this->findWeeklyReportBySlug($slug);

        if($get == 'toDate'){
            $relation = $weekly_report->form2ToDateAsOf($report_no != 0 ? $report_no : $weekly_report->report_no * 1);
        }else{
            $relation = $weekly_report->form2;
        }
        //carryOver
        $formArray['carryOver'] = $this->makeCurrentPrev($relation->carryOver ?? null, $relation->prev_carryOver ?? null);
        //coveredBySro
        $formArray['coveredBySro'] = $this->makeCurrentPrev($relation->coveredBySro ?? null, $relation->prev_coveredBySro ?? null);
        $formArray['notCoveredBySro'] = $this->makeCurrentPrev($relation->notCoveredBySro ?? null, $relation->prev_notCoveredBySro ?? null);
        $formArray['otherMills'] = $this->makeCurrentPrev($relation->otherMills ?? null, $relation->prev_otherMills ?? null);
        $formArray['imported'] = $this->makeCurrentPrev($relation->imported ?? null, $relation->prev_imported ?? null);

        //receipts
        $formArray['receipts'] = [
            'coveredBySro' => $this->makeCurrentPrev($relation->coveredBySro ?? null, $relation->prev_coveredBySro ?? null),
            'notCoveredBySro' => $this->makeCurrentPrev($relation->notCoveredBySro ?? null, $relation->prev_notCoveredBySro ?? null),
            'otherMills' => $this->makeCurrentPrev($relation->otherMills ?? null, $relation->prev_otherMills ?? null),
            'imported' => $this->makeCurrentPrev($relation->imported ?? null, $relation->prev_imported ?? null),
        ];

        $formArray['totalReceipts']['current'] = array_sum(array_column($formArray['receipts'],'current'));
        $formArray['totalReceipts']['prev'] = array_sum(array_column($formArray['receipts'],'prev'));

        $formArray['melted'] = $this->makeCurrentPrev($relation->melted ?? null, $relation->prev_melted ?? null);;
        $formArray['rawWithdrawals'] = $this->makeCurrentPrev($relation->rawWithdrawals ?? null, $relation->prev_rawWithdrawals ?? null);;
        $formArray['rawBalance']['current'] = $formArray['totalReceipts']['current'] - $formArray['melted']['current'] - $formArray['rawWithdrawals']['current'];
        $formArray['rawBalance']['prev'] = $formArray['totalReceipts']['prev'] - $formArray['melted']['prev'] - $formArray['rawWithdrawals']['prev'];


        //production
        $formArray['production'] = [
            'domestic' => $this->makeCurrentPrev($relation->prodDomestic ?? null,$relation->prev_prodDomestic ?? null),
            'imported' => $this->makeCurrentPrev($relation->prodImported ?? null,$relation->prev_prodImported ?? null),
            'overage' => $this->makeCurrentPrev($relation->overage ?? null,$relation->prev_overage ?? null),
            'returnToProcess' => $this->makeCurrentPrev($relation->prodReturn ?? null,$relation->prev_prodReturn ?? null),
        ];

        //carry Over
        $formArray['refinedCarryOver'] = [
            'prev' => $relation->prev_refinedCarryOver ?? null,
        ];

        //TOTAL PRODUCTION
//        $formArray['totalProduction'] = [
//            'current' => array_sum(array_column($formArray['production'],'current')),
//            'prev' => array_sum(array_column($formArray['production'],'prev')),
//        ];
//        $formArray['totalProduction'] = [
//            'current' => $formArray['production']['domestic']['current'] -,
//            'prev' => array_sum(array_column($formArray['production'],'prev')),
//        ];


        //TOTAL REFINED
        $formArray['totalRefined'] = [
            'current' => $formArray['production']['domestic']['current'] + $formArray['production']['imported']['current'] + $formArray['production']['overage']['current'],
            'prev' => $formArray['production']['domestic']['prev'] + $formArray['production']['imported']['prev'] + $formArray['production']['overage']['prev'],
        ];

        $formArray['totalProduction'] = [
            'current' => $formArray['totalRefined']['current'] - $formArray['production']['returnToProcess']['current'] ,
            'prev' =>  $formArray['totalRefined']['prev'] - $formArray['production']['returnToProcess']['prev'],
        ];



        $formArray['issuances'] = [];
        //ISSUANCES

        if($get == 'toDate'){
            $is = IssuancesOfSro::query()
                ->selectRaw('consumption, sum(refined_qty) as currentTotal, sum(prev_refined_qty) as prevTotal')
                ->leftJoin('weekly_reports','weekly_reports.slug','=','form5a_issuances_of_sro.weekly_report_slug')
                ->where('crop_year','=',$weekly_report->crop_year)
                ->where('mill_code','=', $weekly_report->mill_code)
                ->where('report_no','<=', $report_no != 0 ? $report_no * 1 : $weekly_report->report_no * 1)
                ->where(function($q){
                    $q->where('weekly_reports.status' ,'!=', -1)
                        ->orWhere('weekly_reports.status', '=', null);
                })
                ->groupBy('consumption')
                ->orderBy('consumption','asc')
                ->get();
        }else{
            $is = $weekly_report->form5aIssuancesOfSro()
                ->selectRaw('consumption, sum(refined_qty) as currentTotal, sum(prev_refined_qty) as prevTotal')
                ->groupBy('consumption')
                ->orderBy('consumption','asc')
                ->get();
        }




        if(!empty($is)){
            foreach ($is as $i){
                $formArray['issuances'][strtolower($i->consumption)]['current'] = $i->currentTotal;
                $formArray['issuances'][strtolower($i->consumption)]['prev'] = $i->prevTotal;

                $formArray[$i->consumption == '' ? 'issuancesBlank' : 'issuances'.ucfirst(strtolower($i->consumption))]['current'] = $i->currentTotal;
                $formArray[$i->consumption == '' ? 'issuancesBlank' : 'issuances'.ucfirst(strtolower($i->consumption))]['prev'] = $i->prevTotal;
            }
        }


        $formArray['issuancesTotal'] = [
            'current' => isset($formArray['issuances']) ? array_sum(array_column($formArray['issuances'],'current')) : null,
            'prev' => isset($formArray['issuances']) ? array_sum(array_column($formArray['issuances'],'prev')) : null,
        ];


        $formArray['withdrawals'] = [];

        //WITHDRAWALS /DELIVERIES
        if($get == 'toDate') {
            $ws = \App\Models\SMS\Form5a\Deliveries::query()
                ->selectRaw('consumption, sum(qty_current) as currentTotal, sum(qty_prev) as prevTotal, weekly_reports.*')
                ->leftJoin('weekly_reports', 'weekly_reports.slug', '=', 'form5a_deliveries.weekly_report_slug')
                ->where('crop_year', '=', $weekly_report->crop_year)
                ->where('mill_code', '=', $weekly_report->mill_code)
                ->where('report_no', '<=', $report_no != 0 ? $report_no : $weekly_report->report_no * 1)
                ->where(function ($q) {
                    $q->where('weekly_reports.status', '!=', -1)
                        ->orWhere('weekly_reports.status', '=', null);
                })
                ->groupBy('consumption')
                ->orderBy('consumption', 'asc')
                ->get();

        }else{
        $ws = $weekly_report->form5aDeliveries()
            ->selectRaw('consumption, sum(qty_current) as currentTotal, sum(qty_prev) as prevTotal')
            ->groupBy('consumption')
            ->orderBy('consumption','asc')
            ->get();
        }

        if(!empty($ws)){
            foreach ($ws as $w){
                $formArray['withdrawals'][strtolower($w->consumption)]['current'] = $w->currentTotal;
                $formArray['withdrawals'][strtolower($w->consumption)]['prev'] = $w->prevTotal;

                $formArray[$w->consumption == '' ? 'withdrawalsBlank' : 'withdrawals'.ucfirst(strtolower($w->consumption))]['current'] = $w->currentTotal;
                $formArray[$w->consumption == '' ? 'withdrawalsBlank' : 'withdrawals'.ucfirst(strtolower($w->consumption))]['prev'] = $w->prevTotal;
            }
        }
        $formArray['withdrawalTotal'] = [
            'current' => isset($formArray['withdrawals']) ?  array_sum(array_column($formArray['withdrawals'],'current')) : null,
            'prev' => isset($formArray['withdrawals']) ?  array_sum(array_column($formArray['withdrawals'],'prev')) : null,
        ];
        //STOCK BALANCE = ISSUANCE - WITHDRAWALS
        $formArray['stockBalance'] = [
            'current' => $formArray['issuancesTotal']['current'] - $formArray['withdrawalTotal']['current'],
            'prev' => $formArray['refinedCarryOver']['prev'] + $formArray['issuancesTotal']['prev'] - $formArray['withdrawalTotal']['prev'],
        ];

        //UNQEUDANNED = PROD NET - ISSUANCES
        $formArray['unquedanned'] = [
            'current' => $formArray['totalProduction']['current'] - $formArray['issuancesTotal']['current'],
            'prev' => $formArray['totalProduction']['prev'] - $formArray['issuancesTotal']['prev'],
        ];
        \Hash::make('dds');
        //STOCK ON HAND = PROD NET - WITHDRAWALS
//        $formArray['stockOnHand'] = [
//            'current' => $formArray['totalProduction']['current'] - $formArray['withdrawalTotal']['current'],
//            'prev' => $formArray['totalProduction']['prev'] - $formArray['withdrawalTotal']['prev'],
//        ];

        //STOCK ON HAND = STOCK BALANCE + UNQUEDANNED
        $formArray['stockOnHand'] = [
            'current' => $formArray['stockBalance']['current'] + $formArray['unquedanned']['current'],
            'prev' => $formArray['stockBalance']['prev'] + $formArray['unquedanned']['prev'],
        ];

        return $formArray;
        echo print('<pre>'.print_r($formArray,true).'</pre>');
        die();
    }

    public function form3Computation($slug,$get='',$report_no = 0){
        $formArray = [];
        $temp = [];
        $wr = $this->findWeeklyReportBySlug($slug);
        if($get == 'toDate'){
            $relation = $wr->form3ToDateAsOf($report_no != 0 ? $report_no * 1 : $wr->report_no * 1);
        }else{
            $relation = $wr->form3;
        }

        //raw
        $formArray['production']['manufacturedRaw']['current'] = $relation->manufacturedRaw ?? null;
        $formArray['production']['manufacturedRaw']['prev'] = $relation->prev_manufacturedRaw ?? null;

        //rao
        $formArray['production']['rao']['current'] = $relation->rao ?? null;
        $formArray['production']['rao']['prev'] = $relation->prev_rao ?? null;
        //refined
        $formArray['production']['manufacturedRefined']['current'] = $relation->manufacturedRefined ?? null;
        $formArray['production']['manufacturedRefined']['prev'] = $relation->prev_manufacturedRefined ?? null;

        //raoRefined
        $formArray['production']['raoRefined']['current'] = $relation->raoRefined ?? null;
        $formArray['production']['raoRefined']['prev'] = $relation->prev_raoRefined ?? null;

        //total production
        $formArray['totalProduction']['current'] = array_sum(array_column($formArray['production'],'current'));
        $formArray['totalProduction']['prev'] = array_sum(array_column($formArray['production'],'prev'));
        //issuances
        //planter share
        $formArray['issuances']['sharePlanter']['current'] = $relation->sharePlanter ?? null;
        $formArray['issuances']['sharePlanter']['prev'] = $relation->prev_sharePlanter ?? null;
        //mill share
        $formArray['issuances']['shareMiller']['current'] = $relation->shareMiller ?? null;
        $formArray['issuances']['shareMiller']['prev'] = $relation->prev_shareMiller ?? null;
        //refinery molasses
        $formArray['issuances']['refineryMolasses']['current'] = $relation->refineryMolasses ?? null;
        $formArray['issuances']['refineryMolasses']['prev'] = $relation->prev_refineryMolasses ?? null;
        //total issuance
        $formArray['totalIssuances']['current'] = array_sum(array_column($formArray['issuances'],'current'));
        $formArray['totalIssuances']['prev'] = array_sum(array_column($formArray['issuances'],'prev'));

        //not covered by MSC
        $formArray['notCoveredByMsc']['current'] = $formArray['totalProduction']['current'] - $formArray['totalIssuances']['current'];
        $formArray['notCoveredByMsc']['prev'] = $formArray['totalProduction']['prev'] - $formArray['totalIssuances']['prev'];

        if($get == 'toDate'){
            $withdrawals = \App\Models\SMS\Form3b\Deliveries::query()
                ->selectRaw('sugar_type, withdrawal_type, sum(qty_current) as totalCurrent, sum(qty_prev) as totalPrev')
                ->leftJoin('weekly_reports','weekly_reports.slug','=','form3b_deliveries.weekly_report_slug')
                ->where('crop_year','=',$wr->crop_year)
                ->where('mill_code','=', $wr->mill_code)
                ->where('report_no','<=', $report_no != 0 ? $report_no * 1 : $wr->report_no * 1)
                ->where(function ($q){
                    $q->where('status','=',1)
                        ->orWhere('status' ,'=',null);
                })
                ->groupBy('sugar_type','withdrawal_type')
                ->get();
//            dd($withdrawals);
        }else{
            $withdrawals = $wr->form3Withdrawals()
                ->selectRaw('sugar_type, withdrawal_type, sum(qty_current) as totalCurrent, sum(qty_prev) as totalPrev')
                ->groupBy('sugar_type','withdrawal_type')
                ->get();
        }

        if(!empty($withdrawals)){
            foreach ($withdrawals as $withdrawal){
                switch ($withdrawal->sugar_type){
                    case 'RAW':
                        $formArray['withdrawalsRaw'][$withdrawal->withdrawal_type]['current'] = $withdrawal->totalCurrent;
                        $formArray['withdrawalsRaw'][$withdrawal->withdrawal_type]['prev'] = $withdrawal->totalPrev;
                        break;
                    case 'REFINED':
                        $formArray['withdrawalsRefined'][$withdrawal->withdrawal_type]['current'] = $withdrawal->totalCurrent;
                        $formArray['withdrawalsRefined'][$withdrawal->withdrawal_type]['prev'] = $withdrawal->totalPrev;
                        break;
                    default:
                        break;
                }
            }
        }
        $formArray['totalWithdrawalsRaw']['current'] = isset($formArray['withdrawalsRaw']) ? array_sum(array_column($formArray['withdrawalsRaw'],'current')) : 0;
        $formArray['totalWithdrawalsRaw']['prev'] = isset($formArray['withdrawalsRaw']) ? array_sum(array_column($formArray['withdrawalsRaw'],'prev')) : 0;
        $formArray['totalWithdrawalsRefined']['current'] = isset($formArray['withdrawalsRefined']) ? array_sum(array_column($formArray['withdrawalsRefined'],'current')) : 0;
        $formArray['totalWithdrawalsRefined']['prev'] = isset($formArray['withdrawalsRefined']) ? array_sum(array_column($formArray['withdrawalsRefined'],'prev')) : 0;
        $formArray['totalWithdrawals']['current'] = $formArray['totalWithdrawalsRaw']['current']  + $formArray['totalWithdrawalsRefined']['current'];
        $formArray['totalWithdrawals']['prev'] = $formArray['totalWithdrawalsRaw']['prev']  + $formArray['totalWithdrawalsRefined']['prev'];
        //balances ;

        $formArray['balanceRaw']['current'] = $formArray['production']['rao']['current'] + $formArray['production']['manufacturedRaw']['current'] - $formArray['totalWithdrawalsRaw']['current'];
        $formArray['balanceRaw']['prev'] = $formArray['production']['rao']['prev'] + $formArray['production']['manufacturedRaw']['prev'] - $formArray['totalWithdrawalsRaw']['prev'];

        $formArray['balanceRefined']['current'] = $formArray['production']['raoRefined']['current'] + $formArray['production']['manufacturedRefined']['current'] - $formArray['totalWithdrawalsRefined']['current'];
        $formArray['balanceRefined']['prev'] = $formArray['production']['raoRefined']['prev']  + $formArray['production']['manufacturedRefined']['prev'] - $formArray['totalWithdrawalsRefined']['prev'];

        $formArray['totalBalance']['current'] = $formArray['balanceRaw']['current'] + $formArray['balanceRefined']['current'];
        $formArray['totalBalance']['prev'] = $formArray['balanceRaw']['prev'] + $formArray['balanceRefined']['prev'];


        //MolassesDistFactor
        $formArray['distFactor'] = $relation->distFactor;
        return $formArray;
        print('<pre>'.print_r($formArray,true).'</pre>');
    }



    public function form3aComputation($slug, $get = '',$report_no = 0){
        $formArray = [];
        $weekly_report = $this->findWeeklyReportBySlug($slug);

        if($get == 'toDate'){
            $relation = $weekly_report->form3aToDateAsOf($report_no != 0 ? $report_no : $weekly_report->report_no * 1);
        }else{
            $relation = $weekly_report->form3a;
        }

        //carryOver
        $formArray['carryOver'] = $this->makeCurrentPrev($relation->carryOver ?? null, $relation->prev_carryOver ?? null);
        //receipts
        $formArray['receipts'] = $this->makeCurrentPrev($relation->receipts ?? null, $relation->prev_receipts ?? null);
        //withdrawals
        $formArray['withdrawals'] = $this->makeCurrentPrev($relation->withdrawals ?? null, $relation->prev_withdrawals ?? null);
        //transferToRefinery
        $formArray['transferToRefinery'] = $this->makeCurrentPrev($relation->transferToRefinery ?? null, $relation->prev_transferToRefinery ?? null);


        //subsidiaries
        if($get == 'toDate'){
            $subs = Subsidiaries::query()
                ->selectRaw('warehouseAlias, name , transactionType, sum(current) as current, sum(prev) as prev')
                ->leftJoin('weekly_reports','weekly_reports.slug','=','sms_subsidiaries.weekly_report_slug')
                ->join('warehouses','warehouses.alias','=','sms_subsidiaries.warehouseAlias')
                ->where('sugarType','=','MOLASSES')
                ->where('crop_year','=',$weekly_report->crop_year)
                ->where('mill_code','=', $weekly_report->mill_code)
                ->where('report_no','<=', $report_no != 0 ? $report_no * 1 : $weekly_report->report_no * 1)
                ->groupBy('transactionType','alias')
                ->orderBy('sms_subsidiaries.id','asc')
                ->get();

        }else{
            $subs = $weekly_report->form3aSubsidiaries()
                ->selectRaw('warehouseAlias, name , transactionType, sum(current) as current, sum(prev) as prev')
                ->leftJoin('warehouses','warehouses.alias','=','sms_subsidiaries.warehouseAlias')
                ->groupBy('transactionType','alias')
                ->orderBy('sms_subsidiaries.id','asc')
                ->get();

        }

        //list subsidiaries
        $whs  = Warehouses::query()->where('millCode','=',Auth::user()->mill_code)->get();
        $warehouseArray = [];
        if(!empty($whs)){
            foreach ($whs as $wh){
                $warehouseArray[$wh->alias]['obj'] = $wh;
            }
        }
        foreach (Arrays::subsidiaryItems() as $key => $item){
            $formArray['subsidiaries'][$key] = $warehouseArray;
        }

        if(!empty($subs)){
            foreach ($subs as $sub){
                $formArray['subsidiaries'][$sub->transactionType][$sub->warehouseAlias]['current'] = $sub->current;
                $formArray['subsidiaries'][$sub->transactionType][$sub->warehouseAlias]['prev'] = $sub->prev;
            }
        }

        foreach (Arrays::subsidiaryItems() as $key => $item){
            $formArray['totals'][$key]['current'] = number_format(array_sum(array_column($formArray['subsidiaries'][$key],'current')),3);
            $formArray['totals'][$key]['prev'] = number_format(array_sum(array_column($formArray['subsidiaries'][$key],'prev')),3);
        }

        return $formArray;
    }


    public function form4Computation($slug, $get = '',$report_no = 0){
        $formArray = [];
        $weekly_report = $this->findWeeklyReportBySlug($slug);

        if($get == 'toDate'){
            $relation = $weekly_report->form4ToDateAsOf($report_no != 0 ? $report_no : $weekly_report->report_no * 1);
        }else{
            $relation = $weekly_report->form4;
        }

        //carryOver
        $formArray['carryOver'] = $this->makeCurrentPrev($relation->carryOver ?? null, $relation->prev_carryOver ?? null);
        //receipts
        $formArray['receipts'] = $this->makeCurrentPrev($relation->receipts ?? null, $relation->prev_receipts ?? null);
        //withdrawals
        $formArray['withdrawals'] = $this->makeCurrentPrev($relation->withdrawals ?? null, $relation->prev_withdrawals ?? null);
        //transferToRefinery
        $formArray['transferToRefinery'] = $this->makeCurrentPrev($relation->transferToRefinery ?? null, $relation->prev_transferToRefinery ?? null);


        //subsidiaries
        if($get == 'toDate'){
            $subs = Subsidiaries::query()
                ->selectRaw('warehouseAlias, name , transactionType, sum(current) as current, sum(prev) as prev')
                ->leftJoin('weekly_reports','weekly_reports.slug','=','sms_subsidiaries.weekly_report_slug')
                ->join('warehouses','warehouses.alias','=','sms_subsidiaries.warehouseAlias')
                ->where('sugarType','=','RAW')
                ->where('crop_year','=',$weekly_report->crop_year)
                ->where('mill_code','=', $weekly_report->mill_code)
                ->where('report_no','<=', $report_no != 0 ? $report_no * 1 : $weekly_report->report_no * 1)
                ->groupBy('transactionType','alias')
                ->orderBy('sms_subsidiaries.id','asc')
                ->get();

        }else{
            $subs = $weekly_report->form4Subsidiaries()
                ->selectRaw('warehouseAlias, name , transactionType, sum(current) as current, sum(prev) as prev')
                ->leftJoin('warehouses','warehouses.alias','=','sms_subsidiaries.warehouseAlias')
                ->groupBy('transactionType','alias')
                ->orderBy('sms_subsidiaries.id','asc')
                ->get();

        }

        //list subsidiaries
        $whs  = Warehouses::query()->where('millCode','=',Auth::user()->mill_code)->get();
        $warehouseArray = [];
        if(!empty($whs)){
            foreach ($whs as $wh){
                $warehouseArray[$wh->alias]['obj'] = $wh;
            }
        }
        foreach (Arrays::subsidiaryItems() as $key => $item){
            $formArray['subsidiaries'][$key] = $warehouseArray;
        }

        if(!empty($subs)){
            foreach ($subs as $sub){
                $formArray['subsidiaries'][$sub->transactionType][$sub->warehouseAlias]['current'] = $sub->current;
                $formArray['subsidiaries'][$sub->transactionType][$sub->warehouseAlias]['prev'] = $sub->prev;
            }
        }

        foreach (Arrays::subsidiaryItems() as $key => $item){
            $formArray['totals'][$key]['current'] = number_format(array_sum(array_column($formArray['subsidiaries'][$key],'current')),3);
            $formArray['totals'][$key]['prev'] = number_format(array_sum(array_column($formArray['subsidiaries'][$key],'prev')),3);
        }

        return $formArray;
    }



    public function form4aComputation($slug, $get = '',$report_no = 0){
        $formArray = [];
        $weekly_report = $this->findWeeklyReportBySlug($slug);

        if($get == 'toDate'){
            $relation = $weekly_report->form4aToDateAsOf($report_no != 0 ? $report_no : $weekly_report->report_no * 1);
        }else{
            $relation = $weekly_report->form4a;
        }

        //carryOver
        $formArray['carryOver'] = $this->makeCurrentPrev($relation->carryOver ?? null, $relation->prev_carryOver ?? null);
        //receipts
        $formArray['receipts'] = $this->makeCurrentPrev($relation->receipts ?? null, $relation->prev_receipts ?? null);
        //withdrawals
        $formArray['withdrawals'] = $this->makeCurrentPrev($relation->withdrawals ?? null, $relation->prev_withdrawals ?? null);
        //transferToRefinery
        $formArray['transferToRefinery'] = $this->makeCurrentPrev($relation->transferToRefinery ?? null, $relation->prev_transferToRefinery ?? null);


        //subsidiaries
        if($get == 'toDate'){
            $subs = Subsidiaries::query()
                ->selectRaw('warehouseAlias, name , transactionType, sum(current) as current, sum(prev) as prev')
                ->leftJoin('weekly_reports','weekly_reports.slug','=','sms_subsidiaries.weekly_report_slug')
                ->join('warehouses','warehouses.alias','=','sms_subsidiaries.warehouseAlias')
                ->where('sugarType','=','REFINED')
                ->where('crop_year','=',$weekly_report->crop_year)
                ->where('mill_code','=', $weekly_report->mill_code)
                ->where('report_no','<=', $report_no != 0 ? $report_no * 1 : $weekly_report->report_no * 1)
                ->groupBy('transactionType','alias')
                ->orderBy('sms_subsidiaries.id','asc')
                ->get();

        }else{
            $subs = $weekly_report->form4aSubsidiaries()
                ->selectRaw('warehouseAlias, name , transactionType, sum(current) as current, sum(prev) as prev')
                ->leftJoin('warehouses','warehouses.alias','=','sms_subsidiaries.warehouseAlias')
                ->groupBy('transactionType','alias')
                ->orderBy('sms_subsidiaries.id','asc')
                ->get();

        }

        //list subsidiaries
        $whs  = Warehouses::query()->where('millCode','=',Auth::user()->mill_code)->get();
        $warehouseArray = [];
        if(!empty($whs)){
            foreach ($whs as $wh){
                $warehouseArray[$wh->alias]['obj'] = $wh;
            }
        }
        foreach (Arrays::subsidiaryItems() as $key => $item){
            $formArray['subsidiaries'][$key] = $warehouseArray;
        }

        if(!empty($subs)){
            foreach ($subs as $sub){
                $formArray['subsidiaries'][$sub->transactionType][$sub->warehouseAlias]['current'] = $sub->current;
                $formArray['subsidiaries'][$sub->transactionType][$sub->warehouseAlias]['prev'] = $sub->prev;
            }
        }

        foreach (Arrays::subsidiaryItems() as $key => $item){
            $formArray['totals'][$key]['current'] = number_format(array_sum(array_column($formArray['subsidiaries'][$key],'current')),3);
            $formArray['totals'][$key]['prev'] = number_format(array_sum(array_column($formArray['subsidiaries'][$key],'prev')),3);
        }

        return $formArray;
    }

    public function subsidiaries($weekly_report_slug){
        $s = Subsidiaries::query()->where('weekly_report_slug','=',$weekly_report_slug)->get();
        $arr = [];
        if(!empty($s)){
            foreach ($s as $item){
                $arr[$item->sugarType][$item->transactionType][$item->slug] = $item;
            }
        }
        return $arr;
    }

    public function seriesNos($weekly_report_slug){
        $s = SeriesNos::query()->where('weekly_report_slug','=',$weekly_report_slug)->get();
        $arr = [];
        if(!empty($s)){
            foreach ($s as $item){
                $arr[$item->type][$item->slug] = $item;
            }
        }
        return $arr;
    }


    public function updateSignatories($weekly_report_slug){
        $wr = $this->findWeeklyReportBySlug($weekly_report_slug);
        if($wr->status != 1){
            $sigs = Signatories::query()->where('mill_code','=',Auth::user()->mill_code)->get();
            $sArr = [];
            if(!empty($sigs)){
                foreach ($sigs as $sig){
                    array_push($sArr,[
                        'weekly_report_slug' => $weekly_report_slug,
                        'form' => $sig->form,
                        'for' => $sig->for,
                        'name' => $sig->name,
                        'position' => $sig->position,
                    ]);
                }
                $wr->savedSignatories()->delete();
                SignatoriesSaved::insert($sArr);
            }
        }

    }

    public function getSignatories($weekly_report_slug){
        $wr = $this->findWeeklyReportBySlug($weekly_report_slug);
        $arr = [];
        if(!empty($wr->savedSignatories)){
            foreach ($wr->savedSignatories as $sig){
                $arr[$sig->form][$sig->for] = [
                    'name' => $sig->name,
                    'position' => $sig->position,
                ];
            }
        }
        return $arr;
    }

    public function cancellationFilePath($weeklyReportObj){
        $filename = $weeklyReportObj->calendar->report_no .' - '.$weeklyReportObj->calendar->week_ending.' - '.\Str::random(6).'.pdf';
        $full_path = 'CANCELLATIONS/'.
            $weeklyReportObj->calendar->crop_year.'/'.
            $weeklyReportObj->mill_code.'/'.$filename;
        return [
            'filename' => $filename,
            'full_path' => $full_path,
        ];
    }
}