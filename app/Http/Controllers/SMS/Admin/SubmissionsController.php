<?php


namespace App\Http\Controllers\SMS\Admin;


use App\Http\Controllers\Controller;
use App\Models\SMS\SugarMills;
use App\SMS\Services\WeeklyReportService;
use Illuminate\Http\Request;

class SubmissionsController extends Controller
{
    protected  $weeklyReportService;
    public function __construct(WeeklyReportService $weeklyReportService)
    {
        $this->weeklyReportService = $weeklyReportService;
    }

    public function index(Request $request){
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
                if(!empty($mill->weeklyReportsSubmitted)){
                    foreach ($mill->weeklyReportsSubmitted as $weeklyReportSubmitted)
                    $arr[$mill->slug]['weeklyReports'][$weeklyReportSubmitted->slug] = [
                        'obj' => $weeklyReportSubmitted,
                    ];
                }
            }
        }

        return view('sms.admin.submissions.index')->with([
            'mills' => $arr,
        ]);
    }

    public function show($slug){
        $wr = $this->weeklyReportService->findWeeklyReportBySlug($slug);
        return view('sms.admin.submissions.show')->with([
            'wr' => $wr,
        ]);
    }
}