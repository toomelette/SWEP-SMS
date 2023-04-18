<?php


namespace App\Http\Controllers\SMS\Admin;


use App\Http\Controllers\Controller;
use App\Models\SMS\Form5\Deliveries;
use App\Models\SMS\Form5\IssuancesOfSro;
use App\Models\SMS\SugarMills;
use App\Models\SMS\WeeklyReports;
use App\SMS\Services\CalendarService;
use App\SMS\Services\WeeklyReportService;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;

class MyMillsController extends Controller
{
    protected $calendarService;
    protected $weeklyReportService;
    public function __construct(CalendarService $calendarService, WeeklyReportService $weeklyReportService)
    {
        $this->calendarService = $calendarService;
        $this->weeklyReportService = $weeklyReportService;
    }

    public function index($mill_code, Request $request){
        if($request->ajax() && $request->has('sro_monitoring')){
            return $this->sroMonitoring($mill_code);
        }
        $cy = '2022-2023';
        $submitted = [];
        $mill = SugarMills::query()->where('slug',$mill_code)->first();
        $wrs = WeeklyReports::query()
            ->where('mill_code','=',$mill_code)
            ->where('status','=',1)
            ->pluck('slug','week_ending');

        return view('sms.admin.my_mills.index')->with([
            'mill_code' => $mill_code,
            'calendar' => $this->calendarService->byYear(),
            'submissions' => $wrs->toArray(),
            'sros' =>  $this->sroMonitoring($mill_code),
        ]);


    }

    public function show($slug){
        $wr = $this->weeklyReportService->findWeeklyReportBySlug($slug);
        return view('sms.admin.my_mills.show')->with([
            'wr' => $wr,
        ]);
    }

    public function sroMonitoring($mill_code){
        $form5Issuances = IssuancesOfSro::query()
            ->whereHas('weeklyReport',function ($q) use ($mill_code){
                $q->where('mill_code','=',$mill_code)
                ->where('status','=',1);
            });
        return \DataTables::of($form5Issuances)
            ->addColumn('qty',function($data){
                return Helper::toNumber($data->qty,3,'');
            })
            ->addColumn('qty_prev',function($data){
                return Helper::toNumber($data->qty_prev,3,'');
            })
            ->addColumn('d_c',function($data){
                return Helper::toNumber($data->deliveries()->sum('qty') ?? 0,3,'');
            })
            ->addColumn('d_p',function($data){
                return Helper::toNumber($data->deliveries()->sum('qty_prev') ?? 0,3,'');
            })
            ->addColumn('b_c',function($data){
                return Helper::toNumber($data->qty - ($data->deliveries()->sum('qty') ?? 0),3,'');
            })
            ->addColumn('b_p',function($data){
                return Helper::toNumber($data->qty_prev - ($data->deliveries()->sum('qty_prev') ?? 0),3,'');
            })
            ->addColumn('action',function($data){
                
            })
            ->escapeColumns([])
            ->setRowId('slug')
            ->toJson();
    }
}