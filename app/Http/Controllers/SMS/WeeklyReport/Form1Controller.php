<?php


namespace App\Http\Controllers\SMS\WeeklyReport;


use App\Http\Controllers\Controller;
use App\Http\Requests\SMS\Form1Request;
use App\Models\SMS\Form1\Form1Details;
use App\Models\SMS\WeeklyReportDetails;
use App\Models\SMS\WeeklyReports;
use App\Models\SMS\WeeklyReportSeriesPcs;
use App\SMS\Services\WeeklyReportService;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Form1Controller extends Controller
{
    public function store(Form1Request $request, WeeklyReportService $weeklyReportService){
        $weeklyReportService->isNotSubmitted($request->weekly_report_slug);
        $details_arr = [];
        $series = [];
        $wr = $this->findWeeklyReportBySlug($request->weekly_report_slug);
        if(!empty($request->data)){
            foreach ($request->data as $form => $children){

                if($form == 'form1'){
                    $form1 = new Form1Details;
                    $form1->weekly_report_slug = $wr->slug;
                    $form1->total_issuance = 0;
                    $form1->prev_total_issuance = 0;
                    $form1->manufactured = Helper::sanitizeAutonum($children['manufactured']['current']) != 0 ? Helper::sanitizeAutonum($children['manufactured']['current']) : null ;
                    $form1->prev_manufactured = Helper::sanitizeAutonum($children['manufactured']['prev']) != 0 ? Helper::sanitizeAutonum($children['manufactured']['prev']) : null;
                    if(isset($children['rawIssuances']) && count($children['rawIssuances']['options']) > 0){
                        foreach ($children['rawIssuances']['options'] as $key => $option){
                            $col = 'prev_'.$option;
                            if(Helper::sanitizeAutonum($children['rawIssuances']['current'][$key]) != 0){
                                $form1->$option = Helper::sanitizeAutonum($children['rawIssuances']['current'][$key]);
                                $form1->total_issuance = $form1->total_issuance + Helper::sanitizeAutonum($children['rawIssuances']['current'][$key]);
                            }else{
                                $form1->total_issuance = null;
                            }
                            if(Helper::sanitizeAutonum($children['rawIssuances']['prev'][$key]) != 0){
                                $form1->$col = Helper::sanitizeAutonum($children['rawIssuances']['prev'][$key]);
                                $form1->prev_total_issuance = $form1->prev_total_issuance + Helper::sanitizeAutonum($children['rawIssuances']['prev'][$key]);
                            }else{
                                $form1->$col = null;
                            }
                        }
                    }


                    $form1->share_planter = $children['sharePlanter'];
                    $form1->share_miller = $children['shareMiller'];
                    $form1->tdc = $children['tdc'];
                    $form1->gtcm = $children['gtcm'];
                    $form1->lkgtc_gross = $children['lkgtc_gross'];
                    $form1->price_A = isset($children['priceA']) ? Helper::sanitizeAutonum($children['priceA']) : null;
                    $form1->price_B = isset($children['priceB']) ? Helper::sanitizeAutonum($children['priceB']) : null;
                    $form1->price_C = isset($children['priceC']) ? Helper::sanitizeAutonum($children['priceC']) : null;
                    $form1->price_C1 = isset($children['priceC1']) ? Helper::sanitizeAutonum($children['priceC1']) : null;
                    $form1->price_D = isset($children['priceD']) ? Helper::sanitizeAutonum($children['priceD']) : null ;
                    $form1->price_DX = isset($children['priceDX']) ? Helper::sanitizeAutonum($children['priceDX']) : null;
                    $form1->price_DE = isset($children['priceDE']) ? Helper::sanitizeAutonum($children['priceDE']) : null;
                    $form1->price_DR = isset($children['priceDR']) ? Helper::sanitizeAutonum($children['priceDR']) : null;
                    $form1->wholesale_raw = isset($children['wholesaleRaw']) ? Helper::sanitizeAutonum($children['wholesaleRaw']) : null;
                    $form1->wholesale_refined = isset($children['wholesaleRefined']) ? Helper::sanitizeAutonum($children['wholesaleRefined']) : null;
                    $form1->retail_raw = isset($children['retailRaw']) ? Helper::sanitizeAutonum($children['retailRaw']) : null;
                    $form1->retail_refined = isset($children['retailRefined']) ? Helper::sanitizeAutonum($children['retailRefined']) : null;
                    $form1->dist_factor = Helper::sanitizeAutonum($children['distFactor']);
                    $form1->remarks = isset($children['remarks']) ? $children['remarks'] : null;
                    $wr->form1()->delete();
                    $form1->save();
                }else{
                    if(!empty($children['current'])){;
                        foreach ($children['current'] as $key => $current){
                            if(!is_array($current)){
                                $prev_val = (isset($children['prev'][$key])) ? $children['prev'][$key] : null;
                                if($current !== null || $prev_val !== null){

                                    array_push($details_arr,[
                                        'slug' => Str::random(25),
                                        'input_field' => $key,
                                        'current_value' => ($current != null) ? Helper::sanitizeAutonum($current) : null,
                                        'prev_value' => ($prev_val != null) ? Helper::sanitizeAutonum($prev_val) : null,
                                        'text_value' => null,
                                        'weekly_report_slug' => $request->weekly_report_slug,
                                        'form_type' => $form,
                                        'grouping' => null,
                                    ]);
                                }
                            }else{
                                foreach ($current as $k => $cur){
                                    $prev_val = (isset($children['prev'][$key][$k])) ? $children['prev'][$key][$k]:null;
                                    if($children['current'][$key][$k] != null || $prev_val != null){
                                        array_push($details_arr,[
                                            'slug' => Str::random(25),
                                            'input_field' => $children['options'][$key][$k],
                                            'current_value' => ($children['current'][$key][$k] != null) ? Helper::sanitizeAutonum($children['current'][$key][$k]) : null,
                                            'prev_value' => ($prev_val != null) ? Helper::sanitizeAutonum($prev_val) : null,
                                            'text_value' => null,
                                            'weekly_report_slug' => $request->weekly_report_slug,
                                            'form_type' => $form,
                                            'grouping' => $key,
                                        ]);
                                    }

                                }
                            }
                        }
                    }
                    if(isset($children['text'])){
                        foreach ($children['text'] as $f => $text){

                            array_push($details_arr, [
                                'slug' => Str::random(25),
                                'input_field' => $f,
                                'current_value' => null,
                                'prev_value' => null,
                                'text_value' => $text,
                                'weekly_report_slug' => $request->weekly_report_slug,
                                'form_type' => $form,
                                'grouping' => null,
                            ]);

                        }
                    }


                    if(isset($children['series'])){
                        foreach ($children['series']['options'] as $key => $qi){
                            if($children['series']['seriesFrom'][$key] != null ||  $children['series']['seriesTo'][$key] != null){
                                array_push($series,[
                                    'weekly_report_slug' => $request->weekly_report_slug,
                                    'input_field' => $qi ,
                                    'series_from' => $children['series']['seriesFrom'][$key],
                                    'series_to' => $children['series']['seriesTo'][$key],
                                    'no_of_pcs' => $children['series']['seriesTo'][$key] - $children['series']['seriesFrom'][$key] + 1,
                                    'form_type' => $form,
                                ]);
                            }
                        }
                    }
                }

            }
            //push to array the quedan issuances


        }



        $wr->details()->delete();
        $wr->seriesNos()->delete();
        //store details to array, insert to database as single query




        WeeklyReportDetails::insert($details_arr);
        WeeklyReportSeriesPcs::insert($series);
        return $request;
    }

    public function findWeeklyReportBySlug($slug){
        $wr = WeeklyReports::query()->where('slug','=',$slug)->first();
        if(empty($wr)){
            abort(503,'Weekly Report not found.');
        }
        return $wr;
    }
}