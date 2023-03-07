<?php


namespace App\Http\Controllers\SMS\Admin;


use App\Swep\Helpers\Get;
use Illuminate\Http\Request;

class ReportsController
{
    public function index(Request $request){
        if(!$request->has('report_no') || !$request->has('crop_year')){
            return view('sms.admin.reports.pre_index');
        }
        if($request->has('type') && $request->type == 'getContent'){
            return view('sms.admin.reports.content')->with([
               'report_no' => $request->report_no,
               'crop_year' => $request->crop_year,
            ]);
        }
        return view('sms.admin.reports.index');
    }
}