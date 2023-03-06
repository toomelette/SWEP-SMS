<?php


namespace App\Http\Controllers\SMS\WeeklyReport;


use App\Http\Controllers\Controller;
use App\Models\SMS\Form2\Form2Details;
use App\Models\SMS\SeriesNos;
use App\SMS\Services\WeeklyReportService;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Form2Controller extends Controller
{
    protected  $weeklyReportService;
    public function __construct(WeeklyReportService $weeklyReportService)
    {
        $this->weeklyReportService = $weeklyReportService;
    }

    public function store(Request $request){
        $wr = $this->weeklyReportService->findWeeklyReportBySlug($request->wr);
        if($request->type != 'updateOnly'){
            Form2Details::updateOrCreate(
                ['weekly_report_slug' => $request->wr],
                [
                    'carryOver'=> Helper::sanitizeAutonum($request->carryOver),
                    'coveredBySro'=> Helper::sanitizeAutonum($request->coveredBySro),
                    'notCoveredBySro'=> Helper::sanitizeAutonum($request->notCoveredBySro),
                    'otherMills'=> Helper::sanitizeAutonum($request->otherMills),
                    'imported'=> Helper::sanitizeAutonum($request->imported),
                    'melted'=> Helper::sanitizeAutonum($request->melted),
                    'rawWithdrawals'=> Helper::sanitizeAutonum($request->rawWithdrawals),
                    'prodDomestic'=> Helper::sanitizeAutonum($request->prodDomestic),
                    'prodImported'=> Helper::sanitizeAutonum($request->prodImported),
                    'overage'=> Helper::sanitizeAutonum($request->overage),
                    'prodReturn'=> Helper::sanitizeAutonum($request->prodReturn),

                    'prev_carryOver'=> Helper::sanitizeAutonum($request->prev_carryOver),
                    'prev_coveredBySro'=> Helper::sanitizeAutonum($request->prev_coveredBySro),
                    'prev_notCoveredBySro'=> Helper::sanitizeAutonum($request->prev_notCoveredBySro),
                    'prev_otherMills'=> Helper::sanitizeAutonum($request->prev_otherMills),
                    'prev_imported'=> Helper::sanitizeAutonum($request->prev_imported),
                    'prev_melted'=> Helper::sanitizeAutonum($request->prev_melted),
                    'prev_rawWithdrawals'=> Helper::sanitizeAutonum($request->prev_rawWithdrawals),

                    'prev_refinedCarryOver'=> Helper::sanitizeAutonum($request->prev_refinedCarryOver),
                    'prev_prodDomestic'=> Helper::sanitizeAutonum($request->prev_prodDomestic),
                    'prev_prodImported'=> Helper::sanitizeAutonum($request->prev_prodImported),
                    'prev_overage'=> Helper::sanitizeAutonum($request->prev_overage),
                    'prev_prodReturn'=> Helper::sanitizeAutonum($request->prev_prodReturn),

                    'remarks' => $request->remarks,
                ]
            );
            $arr = [];
            if(!empty($request->seriesNos)){
                foreach ($request->seriesNos['sugarClass'] as $key => $value){
                    array_push($arr,[
                        'slug' => Str::random(),
                        'weekly_report_slug' => $request->wr,
                        'sugarClass' => $value,
                        'seriesFrom' => $request->seriesNos['seriesFrom'][$key],
                        'seriesTo' => $request->seriesNos['seriesTo'][$key],
                        'noOfPcs' => $request->seriesNos['seriesTo'][$key] - $request->seriesNos['seriesFrom'][$key] + 1,
                        'type' => 'REFINED',
                    ]);
                }
            }
            $wr->refinedSeriesNos()->delete();
            if(count($arr) > 0){
                SeriesNos::insert($arr);
            }
        }

        return $this->weeklyReportService->form2Computation($request->wr);
    }
}