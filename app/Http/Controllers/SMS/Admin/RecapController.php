<?php


namespace App\Http\Controllers\SMS\Admin;


use App\Models\SMS\SugarMills;
use App\Models\SMS\WeeklyReports;
use App\SMS\Services\WeeklyReportService;
use Illuminate\Http\Request;

class RecapController
{
    protected $weeklyReportService;
    public function __construct(WeeklyReportService $weeklyReportService)
    {
        $this->weeklyReportService = $weeklyReportService;
    }

    public function comparativeGtcm(Request $request){
        $report_no = $request->report_no;
        $crop_year = $request->crop_year;
        $comparativeGtcmArray = [];
        $millsArray = [];
        $wrs = WeeklyReports::query()
            ->where('status','=',1)
            ->where('report_no','=',$report_no)
            ->where('crop_year','=',$crop_year)
            ->get();
        $mills = SugarMills::query()->get();
        if(!empty($mills)){
            foreach ($mills as $mill){
                $comparativeGtcmArray[$mill->group][$mill->slug] = [];
            }
        }

        if(!empty($wrs)){
            foreach ($wrs as $wr){
                $comparativeGtcmArray[$wr->sugarMill->group ?? ''][$wr->sugarMill->slug ?? ''] = [
                    'gtcm' => $wr->form1->gtcm ?? null,
                    'lkgtcGross' => $wr->form1->lkgtc_gross ?? null,
                    'rawSugarProduction' => $wr->form1->manufactured ?? null,
                ];
            }
        }
        return view('sms.printables.comparative.gtcm')->with([
            'current' => $comparativeGtcmArray,
        ]);
    }

    public function raw1(Request $request){
        $report_no = $request->report_no * 1;
        $crop_year = $request->crop_year;

        $comparativeArray = [];
        $mills = SugarMills::query()->get();
        if(!empty($mills)){
            foreach ($mills as $mill){
                $comparativeArray[$mill->group][$mill->slug] = [
                    'weeklyReportSlug' => null,
                    'form1' => [],
                ];
            }
        }

        //populate slugs
        $wrs = WeeklyReports::query()
            ->with('sugarMill')
            ->select('slug','mill_code')
            ->where('status','=',1)
            ->where('report_no','=',$report_no)
            ->where('crop_year','=',$crop_year)
            ->get();
        if(!empty($wrs)){
            foreach ($wrs as $wr){
                $comparativeArray[$wr->sugarMill->group][$wr->sugarMill->slug]['weeklyReportSlug'] = $wr->slug;
                $comparativeArray[$wr->sugarMill->group][$wr->sugarMill->slug]['form1'] = [
                    'thisWeek' => $this->weeklyReportService->computation($wr->slug,'',$report_no),
                    'prevToDate' => $this->weeklyReportService->computation($wr->slug,'toDate',$report_no - 1),
                    'toDate' => $this->weeklyReportService->computation($wr->slug,'toDate',$report_no),
                ];
            }
        }
        return view('sms.printables.comparative.raw1')->with([
            'comparativeArray' => $comparativeArray,
        ]);
    }

    public function molPWS(Request $request){
        $report_no = $request->report_no * 1;
        $crop_year = $request->crop_year;

        $comparativeArray = [];
        $mills = SugarMills::query()->get();
        if(!empty($mills)){
            foreach ($mills as $mill){
                $comparativeArray[$mill->group][$mill->slug] = [
                    'weeklyReportSlug' => null,
                    'form3' => [],
                ];
            }
        }
        //populate slugs
        $wrs = WeeklyReports::query()
            ->with('sugarMill')
            ->select('slug','mill_code')
            ->where('status','=',1)
            ->where('report_no','=',$report_no)
            ->where('crop_year','=',$crop_year)
            ->get();
        if(!empty($wrs)){
            foreach ($wrs as $wr){
                $comparativeArray[$wr->sugarMill->group][$wr->sugarMill->slug]['weeklyReportSlug'] = $wr->slug;
                $comparativeArray[$wr->sugarMill->group][$wr->sugarMill->slug]['form3'] = [
                    'thisWeek' => $this->weeklyReportService->form3Computation($wr->slug,'',$report_no),
                    'prevToDate' => $this->weeklyReportService->form3Computation($wr->slug,'toDate',$report_no - 1),
                    'toDate' => $this->weeklyReportService->form3Computation($wr->slug,'toDate',$report_no),
                ];
            }
        }
        return view(    'sms.printables.comparative.molPWS')->with([
            'millsArray' => $comparativeArray,
        ]);
    }

    public function refPWS(Request $request){
        $report_no = $request->report_no * 1;
        $crop_year = $request->crop_year;

        $comparativeArray = [];
        $mills = SugarMills::query()
            ->where('has_refinery','=',1)
            ->get();
        if(!empty($mills)){
            foreach ($mills as $mill){
                $comparativeArray[$mill->group][$mill->slug] = [
                    'weeklyReportSlug' => null,
                    'form2' => [],
                ];
            }
        }

        //populate slugs
        $wrs = WeeklyReports::query()
            ->with('sugarMill')
            ->select('slug','mill_code')
            ->where('status','=',1)
            ->where('report_no','=',$report_no)
            ->where('crop_year','=',$crop_year)
            ->whereHas('sugarMill',function ($query){
                return $query->where('has_refinery','=',1);
            })
            ->get();
        if(!empty($wrs)){
            foreach ($wrs as $wr){
                $comparativeArray[$wr->sugarMill->group][$wr->sugarMill->slug]['weeklyReportSlug'] = $wr->slug;
                $comparativeArray[$wr->sugarMill->group][$wr->sugarMill->slug]['form2'] = [
                    'thisWeek' => $this->weeklyReportService->form2Computation($wr->slug,'',$report_no),
                    'prevToDate' => $this->weeklyReportService->form2Computation($wr->slug,'toDate',$report_no - 1),
                    'toDate' => $this->weeklyReportService->form2Computation($wr->slug,'toDate',$report_no),
                ];
            }
        }

        return view('sms.printables.comparative.refPWS')->with([
            'millsArray' => $comparativeArray,
        ]);

    }
}