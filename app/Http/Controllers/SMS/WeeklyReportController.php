<?php


namespace App\Http\Controllers\SMS;


use App\Http\Controllers\Controller;
use App\Models\SMS\ReportTypes;
use Illuminate\Http\Request;

class WeeklyReportController extends Controller
{
    public function index(){
        return 1;
    }

    public function create(Request $request){
        if($request->has('report_type')){
            $report_type = $this->findReportTypeBySlug($request->report_type);
            return view('sms.weekly_report.report_types.weekly_raw')->with([
                'report_type' => $report_type,
            ]);
        }
        return view('sms.weekly_report.create');
    }

    public function findReportTypeBySlug($slug){
        $rt = ReportTypes::query()->where('slug','=',$slug)->first();
        if(empty($rt)){
            abort(503,'Report type not found.');
        }
        return $rt;
    }

    public function store(Request $request){
        return $request->form;
    }
}