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
use App\SMS\Services\DashboardService;
use App\Swep\Helpers\__calendar;
use App\Swep\Helpers\Arrays;
use App\Swep\Services\HomeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller{
    



	protected $home;
    protected $dashboardService;



    public function __construct(HomeService $home, DashboardService $dashboardService){

        $this->home = $home;
        $this->dashboardService = $dashboardService;
    }


    public function index(Request $request){
        $response = new Response('Hello World');


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
        if(Auth::user()->access == 'ADMIN'){



            return view('sms.home.admin.index')->with([
                'totalRawSugarIssuances' => $totalRawSugarIssuances,
                'totalRawSugarDeliveries' => $totalRawSugarDeliveries,
                'closestSundayAhead' => $closestSundayAhead,
                'prevSunday' => Carbon::parse($closestSundayAhead)->subDays(7),
                'millGatePricePrev' => $this->dashboardService->getMillGatePrice( Carbon::parse($closestSundayAhead)->subDays(7)),
                'millGatePriceDiffPerc' => $this->dashboardService->getMillGatePrice( Carbon::parse($closestSundayAhead)->subDays(14)),
                'cy' => $cy,

                'currentWeek' => [
                    'rawProduction' => __calendar::currentWeek()->weeklyReportsForm1()->sum('manufactured') ?? 0,
                    'rawWithdrawals' => __calendar::currentWeek()->weeklyReportsForm5()->sum('qty') ?? 0,
                    'wholesaleRaw' => __calendar::currentWeek()->weeklyReportsForm1()->avg('wholesale_raw') ?? 0,
                    'wholesaleRefined' => __calendar::currentWeek()->weeklyReportsForm1()->avg('wholesale_refined') ?? 0,
                ],

                'previousWeek' => [
                    'rawProduction' => __calendar::previousWeek()->weeklyReportsForm1()->sum('manufactured') ?? 0,
                    'rawWithdrawals' => __calendar::previousWeek()->weeklyReportsForm5()->sum('qty') ?? 0,
                    'wholesaleRaw' => __calendar::previousWeek()->weeklyReportsForm1()->avg('wholesale_raw') ?? 0,
                    'wholesaleRefined' => __calendar::previousWeek()->weeklyReportsForm1()->avg('wholesale_refined') ?? 0,
                ]

            ]);
        }
        return view('dashboard.home.homeAdmin')->with([
            'totalRawSugarIssuances' => $totalRawSugarIssuances,
            'totalRawSugarDeliveries' => $totalRawSugarDeliveries,
            'closestSundayAhead' => $closestSundayAhead,
            'cy' => $cy,
        ]);


    }

    public function weeklyData(Request $request){
        if(!$request->has('week_ending')){
            return redirect(route('dashboard.home.weekly_data').'?week_ending='.__calendar::currentWeek()->week_ending);
        }
        $sugarMillsArray = [];
        $currentWeek = __calendar::currentWeek($request->week_ending);
        foreach ($currentWeek->weeklyReportsForm1 as $item){
            $sugarMillsArray[$item->weeklyReport->mill_code]['production'] = $item->manufactured;
            $sugarMillsArray[$item->weeklyReport->mill_code]['withdrawals'] = null;
        }

        $form5Deliveries = $currentWeek->weeklyReportsForm5;
        foreach ($form5Deliveries as $item){
            if(isset($sugarMillsArray[$item->weeklyReport->mill_code])){
                $sugarMillsArray[$item->weeklyReport->mill_code]['withdrawals'] = $sugarMillsArray[$item->weeklyReport->mill_code]['withdrawals'] + $item->qty;
            }
            $sugarMillsArray[$item->weeklyReport->mill_code]['withdrawals'] =  $item->qty;
        }
        foreach ($sugarMillsArray as $key => $mill){
            $sugarMillsArray[$key]['color'] = 'rgb('.rand(1,255).','.rand(1,255).','.rand(1,255).')';
        }

        return view('sms.home.admin.weekly_data')->with([
            'mills' => $sugarMillsArray,
            'request_week' => __calendar::currentWeek($request->week_ending),
        ]);
    }
}
