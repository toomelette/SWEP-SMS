<?php


namespace App\Http\Controllers\SMS\WeeklyReport;


use App\Http\Controllers\Controller;
use App\Models\SMS\Form3\Form3Details;
use App\Models\SMS\SeriesNos;
use App\SMS\Services\WeeklyReportService;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Form3Controller extends Controller
{
    protected $weeklyReportService;
    public function __construct( WeeklyReportService $weeklyReportService )
    {
        $this->weeklyReportService = $weeklyReportService;
    }

    public function store(Request $request){
        $wr = $this->weeklyReportService->findWeeklyReportBySlug($request->wr);
        if($request->type != 'updateOnly'){
            Form3Details::updateOrCreate(
                ['weekly_report_slug' => $request->wr],
                [
                    'manufacturedRaw' => Helper::sanitizeAutonum($request->manufacturedRaw),
                    'rao' => Helper::sanitizeAutonum($request->rao),
                    'manufacturedRefined' => Helper::sanitizeAutonum($request->manufacturedRefined),
                    'raoRefined' => Helper::sanitizeAutonum($request->raoRefined),
                    'sharePlanter' => Helper::sanitizeAutonum($request->sharePlanter),
                    'shareMiller' => Helper::sanitizeAutonum($request->shareMiller),
                    'refineryMolasses' => Helper::sanitizeAutonum($request->refineryMolasses),

                    'prev_manufacturedRaw' => Helper::sanitizeAutonum($request->prev_manufacturedRaw),
                    'prev_rao' => Helper::sanitizeAutonum($request->prev_rao),
                    'prev_manufacturedRefined' => Helper::sanitizeAutonum($request->prev_manufacturedRefined),
                    'prev_raoRefined' => Helper::sanitizeAutonum($request->prev_raoRefined),
                    'prev_sharePlanter' => Helper::sanitizeAutonum($request->prev_sharePlanter),
                    'prev_shareMiller' => Helper::sanitizeAutonum($request->prev_shareMiller),
                    'prev_refineryMolasses' => Helper::sanitizeAutonum($request->prev_refineryMolasses),

                    'price' => Helper::sanitizeAutonum($request->price),
                    'priceRaw' => Helper::sanitizeAutonum($request->priceRaw),
                    'priceRefined' => Helper::sanitizeAutonum($request->priceRefined),

                    'storageCertRaw' => $request->storageCertRaw,
                    'storageCertRefined' => $request->storageCertRefined,
                    'distFactor' => Helper::sanitizeAutonum($request->distFactor),
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
                        'type' => 'MOLASSES',
                        'sugarType' => $request->seriesNos['sugarType'][$key],
                    ]);
                }
            }
            $wr->molassesSeriesNos()->delete();
            if(count($arr) > 0){
                SeriesNos::insert($arr);
            }
        }
        return $this->weeklyReportService->form3Computation($request->wr);
    }
}