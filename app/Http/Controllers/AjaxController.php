<?php


namespace App\Http\Controllers;


use App\Models\Applicant;
use App\Models\ApplicantPositionApplied;
use App\Models\Course;
use App\Models\Document;
use App\Models\Employee;
use App\Models\HRPayPlanitilla;
use App\Models\SMS\SugarOrders;
use App\Models\SMS\WeeklyReportDetails;
use App\Models\SMS\WeeklyReports;
use App\Models\SSL;
use App\Swep\Helpers\Helper;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
    public function get($for){
        if($for == 'issuances_by_sugar_order'){

            return  view('sms.weekly_report.ajax.form1.issuances')->with([
                'manufactured_current' => Request::get('manufactured_current'),
                'manufactured_prev' => Request::get('manufactured_prev'),
                'weekly_report_slug' => Request::get('weekly_report_slug'),
            ]);
        }

        if($for == 'chartAdmin'){
            $request = Request();

            $a = \App\Models\SMS\CropYears::query()
                ->where('is_current' ,'=',1)
                ->first();
            $cy = $a->name;
            $weeksNamesArray = [];
            $weeksArray = [];

            $start_date = \Illuminate\Support\Carbon::parse($a->date_start);
            while ($start_date->format('Ymd') != Carbon::now()->format('Ymd')){
                $start_date = $start_date->addDays(1);
                if($start_date->format('w') == 0){
                    array_push($weeksNamesArray,$start_date->format('M d, Y'));
                    $weeksArray[$start_date->format('Y-m-d')] = [];

                }
            }
            $productions = [];
            $withdrawals = [];

            $prods = \App\Models\SMS\WeeklyReports::query()
                ->where('crop_year','=',$a->name)
                ->where('mill_code','=',\Illuminate\Support\Facades\Auth::user()->mill_code)
                ->get();

            $manufactured = WeeklyReportDetails::query()->where('input_field','=','manufactured')
                            ->where('form_type','=','form1')
                            ->whereHas('weeklyReport',function ($query) use ($cy, $request){
                                $q = $query->where('crop_year','=',$cy);
                                if(!empty($request->mill_code)){
                                    $q->where('crop_year','=',$cy)->where('mill_code','=',$request->mill_code);
                                }
                            })
                            ->get();
            foreach ($manufactured as $man){
                if(isset($weeksArray[$man->weeklyReport->week_ending]['production'])){
                    $weeksArray[$man->weeklyReport->week_ending]['production'] = $weeksArray[$man->weeklyReport->week_ending]['production'] + $man->current_value;
                }else{
                    $weeksArray[$man->weeklyReport->week_ending]['production'] = $man->current_value;
                }
            }

            $wids = WeeklyReportDetails::query()->where('grouping','=','withdrawals')
                ->where('form_type','=','form1')
                ->whereHas('weeklyReport',function ($query) use ($cy, $request){
                    $q = $query->where('crop_year','=',$cy);
                    if(!empty($request->mill_code)){
                        $q->where('crop_year','=',$cy)->where('mill_code','=',$request->mill_code);
                    }
                })
                ->get();
            foreach ($wids as $wid){
                if(!empty($wid->weeklyReport)){
                    if(isset($weeksArray[$wid->weeklyReport->week_ending]['withdrawals'])){
                        $weeksArray[$wid->weeklyReport->week_ending]['withdrawals'] = $weeksArray[$wid->weeklyReport->week_ending]['withdrawals'] + $wid->current_value;
                    }else{
                        $weeksArray[$wid->weeklyReport->week_ending]['withdrawals'] = $wid->current_value;
                    }
                }
            }

            foreach ($weeksArray as $week){

                (isset($week['production'])) ? array_push($productions,$week['production']) : array_push($productions,0);
                (isset($week['withdrawals'])) ? array_push($withdrawals,$week['withdrawals']) : array_push($withdrawals,0);

            }


            return [
                'labels' => $weeksNamesArray,
                'data' => [
                    'productions' => $productions,
                    'withdrawals' => $withdrawals,
                ]
            ];

        }



        return view('sms.dynamic_rows.'.$for);
    }


    public function unused(){

//                foreach ($prods as $prod){
//                $man = WeeklyReportDetails::query()->where('input_field','=','manufactured')->where('form_type','=','form1')->sum('current_value');
//                if(!empty($man)){
//                    if(isset($weeksArray[$prod->week_ending])){
//                        $weeksArray[$prod->week_ending]['production'] = $man;
//                        array_push($productions,$man);
//                    }
//                }
//
//                $wid = WeeklyReportDetails::query()->where('grouping','=','withdrawals')->where('form_type','=','form1')->sum('current_value');
//                if(!empty($wid)){
//                    if(isset($weeksArray[$prod->week_ending])){
//                        $weeksArray[$prod->week_ending]['withdrawals'] = $wid;
//                        array_push($withdrawals,$wid);
//                    }
//                }
//            }
    }

}