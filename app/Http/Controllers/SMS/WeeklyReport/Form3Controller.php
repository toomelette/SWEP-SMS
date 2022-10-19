<?php


namespace App\Http\Controllers\SMS\WeeklyReport;


use App\Http\Controllers\Controller;
use App\Models\SMS\Form3\Form3Details;
use App\SMS\Services\WeeklyReportService;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;

class Form3Controller extends Controller
{
    protected $weeklyReportService;
    public function __construct( WeeklyReportService $weeklyReportService )
    {
        $this->weeklyReportService = $weeklyReportService;
    }

    public function store(Request $request){
        if($request->type != 'updateOnly'){
            Form3Details::updateOrCreate(
                ['weekly_report_slug' => $request->wr],
                [
                    'manufacturedRaw' => Helper::sanitizeAutonum($request->manufacturedRaw),
                    'rao' => Helper::sanitizeAutonum($request->rao),
                    'manufacturedRefined' => Helper::sanitizeAutonum($request->manufacturedRefined),
                    'sharePlanter' => Helper::sanitizeAutonum($request->sharePlanter),
                    'shareMiller' => Helper::sanitizeAutonum($request->shareMiller),
                    'refineryMolasses' => Helper::sanitizeAutonum($request->refineryMolasses),

                    'prev_manufacturedRaw' => Helper::sanitizeAutonum($request->prev_manufacturedRaw),
                    'prev_rao' => Helper::sanitizeAutonum($request->prev_rao),
                    'prev_manufacturedRefined' => Helper::sanitizeAutonum($request->prev_manufacturedRefined),
                    'prev_sharePlanter' => Helper::sanitizeAutonum($request->prev_sharePlanter),
                    'prev_shareMiller' => Helper::sanitizeAutonum($request->prev_shareMiller),
                    'prev_refineryMolasses' => Helper::sanitizeAutonum($request->prev_refineryMolasses),

                    'priceRaw' => Helper::sanitizeAutonum($request->priceRaw),
                    'priceRefined' => Helper::sanitizeAutonum($request->priceRefined),

                    'storageCertRaw' => $request->storageCertRaw,
                    'storageCertRefined' => $request->storageCertRefined,
                    'distFactor' => Helper::sanitizeAutonum($request->distFactor),
                ]
            );
        }
        return $this->weeklyReportService->form3Computation($request->wr);
    }
}