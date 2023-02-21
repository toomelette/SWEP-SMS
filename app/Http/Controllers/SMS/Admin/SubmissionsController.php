<?php


namespace App\Http\Controllers\SMS\Admin;


use App\Http\Controllers\Controller;
use App\Models\SMS\CropYears;
use App\Models\SMS\SugarMills;
use App\SMS\Services\WeeklyReportService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubmissionsController extends Controller
{
    protected  $weeklyReportService;
    public function __construct(WeeklyReportService $weeklyReportService)
    {
        $this->weeklyReportService = $weeklyReportService;
    }

    public function index(Request $request){

        if($request->ajax()){
            return $this->byMonth($request->month);
        }
        if(!$request->has('cy')){
            $latestCy = CropYears::query()->orderBy('name','desc')->first();
            if(!empty($latestCy)){
                return redirect(route('dashboard.submissions.index').'?cy='.$latestCy->name.'&type='.($request->type??'month'));
            }
            abort(510, 'No crop year found');
        }

        if($request->has('type') && $request->type == 'year'){
            return $this->byYear($request);
        }elseif($request->has('type') && $request->type == 'month'){
            return view('sms.admin.submissions.index')->with($this->byMonth(Carbon::now()->format('Y-m-01')));
        }

    }

    public function byMonth($month)
    {

        $weeksArray = [];
        $dateStarted = $month;
        $dateEnded = Carbon::parse($month)->addMonth(1)->format('Y-m-d');
        while ($dateStarted < $dateEnded) {
            if(Carbon::parse($dateStarted)->dayOfWeek == 0){
                $weeksArray[Carbon::parse($dateStarted)->format('Y-m-d')] = [];
            }
            $dateStarted = Carbon::parse($dateStarted)->addDays(1);
        }
        $monthOnly = substr($month,0,7);

        $arr = [];
        $mills = SugarMills::query()
            ->with(['weeklyReportsSubmitted'])

            ->orderBy('slug','asc')->get();

        if(!empty($mills)){
            foreach ($mills as $mill){
                $arr[$mill->slug] = [
                    'obj' => $mill,
                    'weeklyReports' => [],
                ];
                $arr[$mill->slug]['weeklyReports'] = $weeksArray;

                if(!empty($mill->weeklyReportsSubmitted)){
                    foreach ($mill->weeklyReportsSubmitted as $weeklyReportSubmitted){
                        if(substr($weeklyReportSubmitted->week_ending,0,7) == $monthOnly){
                            $arr[$mill->slug]['weeklyReports'][$weeklyReportSubmitted->week_ending] = [
                                'obj' => $weeklyReportSubmitted,
                            ];
                        }
                    }
                }
            }
        }
        return [
            'content2' => view('sms.admin.submissions.monthly')->with([
                'mills' => $arr,
                'weeksArray' => $weeksArray,
                'currentMonth' => $month,
            ])->render()
        ];

    }
    public function byYear($request){
        $cy = $latestCy = CropYears::query()
            ->where('name','=',$request->cy)
            ->orderBy('name','desc')->first();
        $weeksArray = [];
        $date_started = $cy->date_start;
        $date_ended = $cy->date_end;

        while ($date_started < $date_ended){
            $weeksArray[Carbon::parse($date_started)->format('Y-m-01')][Carbon::parse($date_started)->format('Y-m-d')] = [];
            $date_started = Carbon::parse($date_started)->addDays(7);
        }


        $arr = [];
        $mills = SugarMills::query()
            ->with(['weeklyReportsSubmitted'])
            ->whereHas('weeklyReportsSubmitted',function ($q) use ($request){
                $q->where('crop_year','=', $request->cy);
            })
            ->orderBy('slug','asc')->get();
        if(!empty($mills)){
            foreach ($mills as $mill){
                $arr[$mill->slug] = [
                    'obj' => $mill,
                    'weeklyReports' => [],
                ];
                $arr[$mill->slug]['weeklyReports'] = $weeksArray;

                if(!empty($mill->weeklyReportsSubmitted)){
                    foreach ($mill->weeklyReportsSubmitted as $weeklyReportSubmitted)
                        $arr[$mill->slug]['weeklyReports'][Carbon::parse($weeklyReportSubmitted->week_ending)->format('Y-m-01')][$weeklyReportSubmitted->week_ending] = [
                            'obj' => $weeklyReportSubmitted,
                        ];
                }
            }
        }
        return view('sms.admin.submissions.index')->with([
            'content2' => view('sms.admin.submissions.yearly')->with([
                'mills' => $arr,
                'weeksArray' => $weeksArray,
            ])
        ]);
    }

    public function show($slug){
        $wr = $this->weeklyReportService->findWeeklyReportBySlug($slug);
        return view('sms.admin.submissions.show')->with([
            'wr' => $wr,
        ]);
    }
}