<?php


namespace App\Http\Controllers\SMS\WeeklyReport;


use App\Http\Controllers\Controller;
use App\Models\SMS\Form2\Form2Details;
use App\SMS\Services\WeeklyReportService;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;

class Form2Controller extends Controller
{
    protected  $weeklyReportService;
    public function __construct(WeeklyReportService $weeklyReportService)
    {
        $this->weeklyReportService = $weeklyReportService;
    }

    public function store(Request $request){
        if($request->type != 'updateOnly'){
            Form2Details::updateOrCreate(
                ['weekly_report_slug' => $request->wr],
                [
                    'carryOver'=> Helper::sanitizeAutonum($request->coveredBySro),
                    'coveredBySro'=> Helper::sanitizeAutonum($request->coveredBySro),
                    'notCoveredBySro'=> Helper::sanitizeAutonum($request->notCoveredBySro),
                    'otherMills'=> Helper::sanitizeAutonum($request->otherMills),
                    'imported'=> Helper::sanitizeAutonum($request->imported),
                    'melted'=> Helper::sanitizeAutonum($request->melted),
                    'rawWithdrawals'=> Helper::sanitizeAutonum($request->rawWithdrawals),
                    'prodDomestic'=> Helper::sanitizeAutonum($request->prodDomestic),
                    'prodImported'=> Helper::sanitizeAutonum($request->prodImported),
                    'prodReturn'=> Helper::sanitizeAutonum($request->prodReturn),

                    'prev_carryOver'=> Helper::sanitizeAutonum($request->coveredBySro),
                    'prev_coveredBySro'=> Helper::sanitizeAutonum($request->prev_coveredBySro),
                    'prev_notCoveredBySro'=> Helper::sanitizeAutonum($request->prev_notCoveredBySro),
                    'prev_otherMills'=> Helper::sanitizeAutonum($request->prev_otherMills),
                    'prev_imported'=> Helper::sanitizeAutonum($request->prev_imported),
                    'prev_melted'=> Helper::sanitizeAutonum($request->prev_melted),
                    'prev_rawWithdrawals'=> Helper::sanitizeAutonum($request->prev_rawWithdrawals),
                    'prev_prodDomestic'=> Helper::sanitizeAutonum($request->prev_prodDomestic),
                    'prev_prodImported'=> Helper::sanitizeAutonum($request->prev_prodImported),
                    'prev_prodReturn'=> Helper::sanitizeAutonum($request->prev_prodReturn),

                ]
            );
        }

        return $this->weeklyReportService->form2Computation($request->wr);
    }
}