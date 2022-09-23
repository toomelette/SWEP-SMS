<?php


namespace App\Http\Controllers\SMS\WeeklyReport;


use App\Models\SMS\ReportTypes;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;

class RawSugarController
{
    public function create($request){
        $report_type = $this->findReportTypeBySlug($request->report_type);
        return view('sms.weekly_report.report_types.weekly_raw')->with([
            'report_type' => $report_type,
        ]);
    }

    public function findReportTypeBySlug($slug){
        $rt = ReportTypes::query()->where('slug','=',$slug)->first();
        if(empty($rt)){
            abort(503,'Report type not found.');
        }
        return $rt;
    }

    public function store(Request $request){
      ;
        return view('sms.weekly_report.report_previews.weekly_raw')->with([
            'request' => $request,
        ]);
    }
}