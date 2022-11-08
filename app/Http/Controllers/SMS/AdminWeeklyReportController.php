<?php


namespace App\Http\Controllers\SMS;


use App\Http\Controllers\Controller;
use App\Models\SMS\WeeklyReports;
use Illuminate\Support\Facades\DB;

class AdminWeeklyReportController extends Controller
{

    public function printComparative($cy,$reportNo){

        $millsByGroupArr = [];


        $mills = DB::table('weekly_reports as wr')
            ->selectRaw("sugar_mills.slug, ifnull(sugar_mills.group,'NO GROUP') as locationGroup , wr.week_ending, wr.crop_year, wr.report_no,
                    sum(form1_details.manufactured) as toDateManufactured,
                    sum(form1_details.gtcm) as toDateGtcm,
                    sum(form1_details.lkgtc_gross) as toDateLkgTcGross,
                    sum(form1_details.tdc) as toDateTdc")
            ->leftJoin('form1_details', function ($join) use ($cy,$reportNo){
                $join->on('form1_details.weekly_report_slug','=','wr.slug')
                    ->where('wr.crop_year','=',$cy)
                    ->where('wr.report_no','<=',$reportNo);
                //WHERE STATUS IS SUMBITTED HERE
            })
            ->rightJoin('sugar_mills','sugar_mills.slug', '=','wr.mill_code')
            ->groupBy('sugar_mills.slug')
            ->orderBy('sugar_mills.slug','asc')
            ->get();


        if(!empty($mills)){
            foreach ($mills as $mill){
                $millsByGroupArr[$mill->locationGroup][$mill->slug] = [
                    'startOfMilling' => '',
                    'endOfMilling' => '',
                    'gtcm' => [
                        'thisWeek' => '',
                        'prevToDate' => '',
                        'toDate' => $mill->toDateGtcm,
                    ],
                    'tdc' => [
                        'thisWeek' => '',
                        'prevToDate' => '',
                        'toDate' => $mill->toDateTdc,
                    ],
                    'rawProduction' => [
                        'thisWeek' => '',
                        'prevToDate'=> '',
                        'toDate' => $mill->toDateManufactured*20,
                    ]
                ];
            }
        }


        ksort($millsByGroupArr);

        if(!empty($millsWithThisWeek)){
            foreach ($millsWithThisWeek as $millWithThisWeek){
                $millsByGroupArr[$millWithThisWeek->group][$millWithThisWeek->mill_code]['gtcm']['thisWeek'] = $millWithThisWeek->gtcm;
                $millsByGroupArr[$millWithThisWeek->group][$millWithThisWeek->mill_code]['tdc']['thisWeek'] = $millWithThisWeek->tdc;
            }
        }

        return view('sms.printables.comparative.all')->with([
            'page1' => [
                'mills' => $millsByGroupArr,
            ]
        ]);
        print('<pre>'.print_r($millsByGroupArr,true).'</pre>');
    }

    public function getPage1($cy,$reportNo){
        $mills = DB::table('weekly_reports as wr')
            ->selectRaw("sugar_mills.slug, ifnull(sugar_mills.group,'NO GROUP') as locationGroup , wr.week_ending, wr.crop_year, wr.report_no,
                    sum(form1_details.manufactured) as toDateManufactured,
                    sum(form1_details.gtcm) as toDateGtcm,
                    sum(form1_details.lkgtc_gross) as toDateLkgTcGross,
                    sum(form1_details.tdc) as toDateTdc")
            ->leftJoin('form1_details', function ($join) use ($cy,$reportNo){
                $join->on('form1_details.weekly_report_slug','=','wr.slug')
                    ->where('wr.crop_year','=',$cy)
                    ->where('wr.report_no','<=',$reportNo);
                //WHERE STATUS IS SUMBITTED HERE
            })
            ->rightJoin('sugar_mills','sugar_mills.slug', '=','wr.mill_code')
            ->groupBy('sugar_mills.slug')
            ->orderBy('sugar_mills.slug','asc')
            ->get();
        return $mills;

//        if(!empty($mills)){
//            foreach ($mills as $mill){
//                $millsByGroupArr[$mill->locationGroup][$mill->slug] = [
//                    'startOfMilling' => '',
//                    'endOfMilling' => '',
//                    'gtcm' => [
//                        'thisWeek' => '',
//                        'prevToDate' => '',
//                        'toDate' => $mill->toDateGtcm,
//                    ],
//                    'tdc' => [
//                        'thisWeek' => '',
//                        'prevToDate' => '',
//                        'toDate' => $mill->toDateTdc,
//                    ]
//                ];
//            }
//        }
//        $millsPrevToDate = $this->getPage1($cy,$reportNo-1);
//        if(!empty($millsPrevToDate)){
//            foreach ($millsPrevToDate as $millPrevToDate) {
//                $millsByGroupArr[$millPrevToDate->locationGroup][$millPrevToDate->slug]['gtcm']['prevToDate'] = $millPrevToDate->toDateGtcm;
//                $millsByGroupArr[$millPrevToDate->locationGroup][$millPrevToDate->slug]['tdc']['prevToDate'] = $millPrevToDate->toDateTdc;
//            }
//        }
    }
}