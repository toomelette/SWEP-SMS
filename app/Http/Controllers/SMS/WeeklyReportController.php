<?php


namespace App\Http\Controllers\SMS;


use App\Http\Controllers\Controller;
use App\Http\Controllers\SMS\WeeklyReport\RawSugarController;
use App\Models\SMS\ReportTypes;
use Illuminate\Http\Request;

class WeeklyReportController extends Controller
{
    public function index(){
        return 1;
    }

    public function create(Request $request, RawSugarController $rawSugarController){

        return view('sms.weekly_report.create');
    }



    public function store(Request $request){
        return $request;
        if($request->previewed == true);
    }
}