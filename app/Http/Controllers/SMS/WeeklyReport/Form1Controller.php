<?php


namespace App\Http\Controllers\SMS\WeeklyReport;


use App\Http\Controllers\Controller;
use App\Http\Requests\SMS\Form1Request;
use App\Models\SMS\WeeklyReportDetails;
use App\Models\SMS\WeeklyReports;
use App\Models\SMS\WeeklyReportSeriesPcs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Form1Controller extends Controller
{
    public function store(Form1Request $request){
//        return $request;
        $details_arr = [];
        $series = [];

        if(!empty($request->data)){
            foreach ($request->data as $form => $children){

                if(!empty($children['current'])){;
                    foreach ($children['current'] as $key => $current){
                        if(!is_array($current)){
                            $prev_val = (isset($children['prev'][$key])) ? $children['prev'][$key] : null;
                            if($current !== null || $prev_val !== null){
                                array_push($details_arr,[
                                    'slug' => Str::random(25),
                                    'input_field' => $key,
                                    'current_value' => $current,
                                    'prev_value' => $prev_val,
                                    'weekly_report_slug' => $request->weekly_report_slug,
                                    'form_type' => $form,
                                    'grouping' => null,
                                ]);
                            }
                        }else{
                            foreach ($current as $k => $cur){
                                $prev_val = (isset($children['prev'][$key][$k])) ? $children['prev'][$key][$k]:null;
                                if($children['current'][$key][$k] != null || $prev_val != null){
                                    array_push($details_arr,[
                                        'slug' => Str::random(25),
                                        'input_field' => $children['options'][$key][$k],
                                        'current_value' => $children['current'][$key][$k],
                                        'prev_value' => $prev_val,
                                        'weekly_report_slug' => $request->weekly_report_slug,
                                        'form_type' => $form,
                                        'grouping' => $key,
                                    ]);
                                }

                            }
                        }
                    }
                }
                if(isset($children['series'])){
                    foreach ($children['series']['options'] as $key => $qi){
                        if($children['series']['seriesFrom'][$key] != null ||  $children['series']['seriesTo'][$key] != null){
                            array_push($series,[
                                'weekly_report_slug' => $request->weekly_report_slug,
                                'input_field' => $qi ,
                                'series_from' => $children['series']['seriesFrom'][$key],
                                'series_to' => $children['series']['seriesTo'][$key],
                                'no_of_pcs' => $children['series']['seriesTo'][$key] - $children['series']['seriesFrom'][$key] + 1,
                                'form_type' => $form,
                            ]);
                        }
                    }
                }
            }
            //push to array the quedan issuances


        }

        $wr = $this->findWeeklyReportBySlug($request->weekly_report_slug);

        $wr->details()->delete();
        $wr->seriesNos()->delete();
        //store details to array, insert to database as single query




        WeeklyReportDetails::insert($details_arr);
        WeeklyReportSeriesPcs::insert($series);
        return $request;
    }

    public function findWeeklyReportBySlug($slug){
        $wr = WeeklyReports::query()->where('slug','=',$slug)->first();
        if(empty($wr)){
            abort(503,'Weekly Report not found.');
        }
        return $wr;
    }
}