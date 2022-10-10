<?php


namespace App\SMS\Services;


use App\Models\SMS\WeeklyReports;
use App\Swep\Helpers\Arrays;
use App\Swep\Helpers\Helper;
use function Doctrine\Common\Cache\Psr6\get;

class WeeklyReportService
{
    public function findWeeklyReportBySlug($slug){
        $wr = WeeklyReports::query()->where('slug','=',$slug)->first();
        if(empty($wr)){
            abort(503,'Weekly Report not found.');
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


    public function computation($slug,$form1Array = null){


        $weekly_report = $this->findWeeklyReportBySlug($slug);




        $valuesStructure = [];
        foreach (Arrays::sugarClasses() as $sugarClass){
            $valuesStructure[$sugarClass] = [
                'current' => null,
                'prev' => null,
            ];
        }
        //MAKE ARRAY TREE
        $formArray['issuances']['values'] = $valuesStructure;
        $formArray['withdrawals']['values'] = $valuesStructure;
        $formArray['forRefining']['values'] = $valuesStructure;
        $formArray['balances']['values'] = $valuesStructure;

        if(!empty($form1Array)){
            //MANUFACTURED
            $formArray['manufactured']['current'] = $form1Array['manufactured']['current'];
            $formArray['manufactured']['prev'] = $form1Array['manufactured']['prev'];
            //ISSUANCES
            $formArray['issuances']['values'] = $form1Array['issuances']['values'];
            $formArray['issuances']['values'] = $form1Array['issuances']['values'];
        }else{
            //MANUFACTURED
            $manufactured = $weekly_report->form1->manufactured ?? null;
            $prev_manufactured = $weekly_report->form1->prev_manufactured ?? null;
            $formArray['manufactured']['current'] = $manufactured;
            $formArray['manufactured']['prev'] = $prev_manufactured;
            //MANUFACTURED

            //ISSUANCES
            if(!empty($weekly_report->form1)){
                foreach (Arrays::sugarClasses() as $sugarClass){
                    $prev = 'prev_'.$sugarClass;
                    $formArray['issuances']['values'][$sugarClass]['current'] = $weekly_report->form1->$sugarClass;
                    $formArray['issuances']['values'][$sugarClass]['prev'] = $weekly_report->form1->$prev;
                }
            }
        }

        $formArray['issuances']['total']['current'] = array_sum(array_column($formArray['issuances']['values'],'current'));
        $formArray['issuances']['total']['prev'] = array_sum(array_column($formArray['issuances']['values'],'prev'));

        //WITHDRAWALS
        $deliveries = $weekly_report->form5Deliveries()
            ->selectRaw('refining, sugar_class,sum(qty) as currentTotal, sum(qty_prev) as prevTotal')
            ->groupBy('refining','sugar_class')
            ->orderBy('sugar_class','asc')
            ->get();

        if(!empty($deliveries)){
            foreach ($deliveries as $delivery){
                if($delivery->refining == null){
                    $key = 'withdrawals';
                }else{
                    $key = 'forRefining';
                }
                $formArray[$key]['values'][$delivery->sugar_class]['current'] = $delivery->currentTotal;
                $formArray[$key]['values'][$delivery->sugar_class]['prev'] = $delivery->prevTotal;
            }
        }
        $formArray['withdrawals']['total']['current'] = array_sum(array_column($formArray['withdrawals']['values'],'current'));
        $formArray['withdrawals']['total']['prev'] = array_sum(array_column($formArray['withdrawals']['values'],'prev'));
        $formArray['forRefining']['total']['current'] = array_sum(array_column($formArray['forRefining']['values'],'current'));
        $formArray['forRefining']['total']['prev'] = array_sum(array_column($formArray['forRefining']['values'],'prev'));

        //BALANCES
        foreach ($formArray['issuances']['values'] as $k => $v){
            $formArray['balances']['values'][$k]['current'] = $formArray['issuances']['values'][$k]['current'] - $formArray['withdrawals']['values'][$k]['current'] - $formArray['forRefining']['values'][$k]['current'];
            $formArray['balances']['values'][$k]['prev'] = $formArray['issuances']['values'][$k]['prev'] - $formArray['withdrawals']['values'][$k]['prev'] - $formArray['forRefining']['values'][$k]['prev'];
        }
        $formArray['balances']['total']['current'] = array_sum(array_column($formArray['balances']['values'],'current'));
        $formArray['balances']['total']['prev'] = array_sum(array_column($formArray['balances']['values'],'prev'));


        //UNQUEDANNED = MANUFACTURED - ISSUANCES
        $formArray['unquedanned'] = [
            'current' => $formArray['manufactured']['current'] - array_sum(array_column($formArray['issuances']['values'],'current')),
            'prev' => $formArray['manufactured']['prev'] - array_sum(array_column($formArray['issuances']['values'],'prev')),
        ];

        //STOCK BALANCE = Manufactured - Withdrawals
        $formArray['stockBalance'] = [
            'current' => $formArray['manufactured']['current'] - array_sum(array_column($formArray['withdrawals']['values'],'current')),
            'prev' => $formArray['manufactured']['prev'] - array_sum(array_column($formArray['withdrawals']['values'],'prev')),
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

        return $formArray;
//        return print('<pre>'.print_r($formArray,true).'</pre>');

        //TRANSFERS TO REFINERY = FORM2 Not covered by SRO * 20

        //PHYSICAL STOCK = STOCK BALANCE - TRANSFERS TO REF;
    }

    public function form2Computation($slug,$form2Array = null){
        $formArray = [];
        $weekly_report = $this->findWeeklyReportBySlug($slug);
        $cp = ['current'=>null,'prev'=>null];
        $formArray = [
            'production' =>[
                'domestic' => $cp,
                'imported' => $cp,
                'returnToProcess' => $cp,
            ]
        ];
        //TOTAL REFINED
        $formArray['production']['totalProduction'] = [
            'current' => array_sum(array_column($formArray['production'],'current')),
            'prev' => array_sum(array_column($formArray['production'],'prev')),
        ];

        $formArray['production']['totalRefined'] = [
            'current' => $formArray['production']['domestic']['current'] + $formArray['production']['imported']['current'],
            'prev' => $formArray['production']['domestic']['prev'] + $formArray['production']['imported']['prev'],
        ];

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
            }
        }
        $formArray['issuances']['total'] = [
            'current' => isset($formArray['issuances']) ? array_sum(array_column($formArray['issuances'],'current')) : null,
            'prev' => isset($formArray['issuances']) ? array_sum(array_column($formArray['issuances'],'prev')) : null,
        ];

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
            }
        }
        $formArray['withdrawals']['total'] = [
            'current' => isset($formArray['withdrawals']) ?  array_sum(array_column($formArray['withdrawals'],'current')) : null,
            'prev' => isset($formArray['withdrawals']) ?  array_sum(array_column($formArray['withdrawals'],'prev')) : null,
        ];
        //STOCK BALANCE = PROD NET - WITHDRAWALS
        $formArray['stockBalance'] = [
            'current' => $formArray['production']['totalProduction']['current'] - $formArray['withdrawals']['total']['current'],
            'prev' => $formArray['production']['totalProduction']['prev'] - $formArray['withdrawals']['total']['prev'],
        ];

        //UNQEUDANNED = PROD NET - ISSUANCES
        $formArray['unquedanned'] = [
            'current' => $formArray['production']['totalProduction']['current'] - $formArray['issuances']['total']['current'],
            'prev' => $formArray['production']['totalProduction']['prev'] - $formArray['issuances']['total']['prev'],
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