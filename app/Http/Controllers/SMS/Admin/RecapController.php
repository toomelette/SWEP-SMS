<?php


namespace App\Http\Controllers\SMS\Admin;


use App\Models\SMS\SugarMills;
use App\Models\SMS\WeeklyReports;
use Illuminate\Http\Request;

class RecapController
{
    public function comparativeGtcm(Request $request){
        $report_no = $request->report_no;
        $crop_year = $request->crop_year;
        $comparativeGtcmArray = [];
        $millsArray = [];
        $wrs = WeeklyReports::query()
            ->where('status','=',1)
            ->where('report_no','=',$report_no)
            ->where('crop_year','=',$crop_year)
            ->get();
        $mills = SugarMills::query()->get();
        if(!empty($mills)){
            foreach ($mills as $mill){
                $comparativeGtcmArray[$mill->group][$mill->slug] = [];
            }
        }

        if(!empty($wrs)){
            foreach ($wrs as $wr){
                $comparativeGtcmArray[$wr->sugarMill->group ?? ''][$wr->sugarMill->slug ?? ''] = [
                    'gtcm' => $wr->form1->gtcm ?? null,
                    'lkgtcGross' => $wr->form1->lkgtc_gross ?? null,
                    'rawSugarProduction' => $wr->form1->manufactured ?? null,
                ];
            }
        }
        return view('sms.printables.comparative.gtcm')->with([
            'current' => $comparativeGtcmArray,
        ]);
    }
}