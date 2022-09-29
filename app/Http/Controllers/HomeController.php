<?php

namespace App\Http\Controllers;


use App\Models\Applicant;
use App\Models\Course;
use App\Models\Document;
use App\Models\DocumentDisseminationLog;
use App\Models\EmailContact;
use App\Models\Employee;
use App\Models\JoEmployees;
use App\Models\LeaveApplication;
use App\Models\News;
use App\Models\PermissionSlip;
use App\Models\SMS\CropYears;
use App\Models\SMS\WeeklyReports;
use App\Swep\Services\HomeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller{
    



	protected $home;




    public function __construct(HomeService $home){

        $this->home = $home;

    }


    public function index(Request $request){
        $cy = CropYears::query()->where('date_start','<=' ,Carbon::now()->format('Ymd'))
            ->where('date_end','>=',Carbon::now()->format('Ymd'))
            ->first();
        $today = Carbon::now();

        if(Carbon::parse($today)->format('w') == 6){
            $closestSundayAhead = Carbon::parse($today)->nextWeekendDay();
        }elseif(Carbon::parse($today)->format('w') == 0){
            $closestSundayAhead = Carbon::parse($today);
        }else{
            $closestSundayAhead = Carbon::parse($today)->nextWeekendDay()->addDay(1);
        }
        $millCode = Auth::user()->mill_code;
        $closestSundayAhead = $closestSundayAhead->format('Y-m-d');
        $wrForThisWeek = WeeklyReports::query()
            ->where('mill_code','=',$millCode)
            ->where('week_ending','=',$closestSundayAhead)
            ->first();
        $totalRawSugarIssuances = (!empty($wrForThisWeek->form5IssuancesOfSro)) ? $wrForThisWeek->form5IssuancesOfSro()->sum('qty') : null;
        $totalRawSugarDeliveries = !empty($wrForThisWeek->form5IssuancesOfSro) ? $wrForThisWeek->form5Deliveries()->sum('qty') : null;
        return view('dashboard.home.home')->with([
            'totalRawSugarIssuances' => $totalRawSugarIssuances,
            'totalRawSugarDeliveries' => $totalRawSugarDeliveries,
            'closestSundayAhead' => $closestSundayAhead,
            'cy' => $cy,
        ]);
    }

}
