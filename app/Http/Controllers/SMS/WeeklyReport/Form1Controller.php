<?php


namespace App\Http\Controllers\SMS\WeeklyReport;


use App\Http\Controllers\Controller;
use App\Http\Requests\SMS\Form1Request;
use App\Models\SMS\WeeklyReportDetails;
use App\Models\SMS\WeeklyReports;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Form1Controller extends Controller
{
    public function store(Form1Request $request){

        $children = [];
        $weekly_report = new WeeklyReports;
        $weekly_report->slug = Str::random();
        $weekly_report->report_type = 'form_1';
        $weekly_report->crop_year = $request->crop_year;
        $weekly_report->dist_no = $request->dist_no;
        $weekly_report->week_ending = $request->week_ending;
        $weekly_report->report_no = $request->report_no;
        $weekly_report->remarks = $request->remarks;

        //store details to array, insert to database as single query
        if(!empty($request->children['current'])){;
            foreach ($request->children['current'] as $key => $current){
                if(!is_array($current)){
                    array_push($children,[
                        'slug' => Str::random(25),
                        'input_field' => $key,
                        'current_value' => $current,
                        'prev_value' => (isset($request->children['prev'][$key])) ? $request->children['prev'][$key] : null,
                        'weekly_report_slug' => $weekly_report->slug,
                    ]);
                }else{
                    foreach ($current as $k => $cur){
                        array_push($children,[
                            'slug' => Str::random(25),
                            'input_field' => $request->children['options'][$key][$k],
                            'current_value' => $request->children['current'][$key][$k],
                            'prev_value' => (isset($request->children['prev'][$key][$k])) ? $request->children['prev'][$key][$k]:null,
                            'weekly_report_slug' => $weekly_report->slug,
                        ]);
                    }
                }
            }
        }

        //save weekly report
        if($weekly_report->save()){
            //if weekly report is saved, save its details
            WeeklyReportDetails::insert($children);
        };
        return $request;
    }

}