<?php


namespace App\Http\Controllers;


use App\Models\Applicant;
use App\Models\ApplicantPositionApplied;
use App\Models\Course;
use App\Models\Document;
use App\Models\Employee;
use App\Models\HRPayPlanitilla;
use App\Models\SMS\CropYears;
use App\Models\SMS\Form1\Form1Details;
use App\Models\SMS\Form3b\IssuancesOfMro;
use App\Models\SMS\Form5\Deliveries;
use App\Models\SMS\Form5\IssuancesOfSro;
use App\Models\SMS\SugarMills;
use App\Models\SMS\SugarOrders;
use App\Models\SMS\WeeklyReportDetails;
use App\Models\SMS\WeeklyReports;
use App\Models\SSL;
use App\Models\Warehouses;
use App\Swep\Helpers\Helper;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
    public function get($for){
        if($for == 'issuances_by_sugar_order'){

            return  view('sms.weekly_report.ajax.form1.issuances')->with([
                'manufactured_current' => Request::get('manufactured_current'),
                'manufactured_prev' => Request::get('manufactured_prev'),
                'weekly_report_slug' => Request::get('weekly_report_slug'),
            ]);
        }

        if($for == 'chartAdmin'){
            $weekStructure = $this->weekStructure('2022-2023',Carbon::now(),[
                'production' => 0,
                'withdrawals' => 0,
            ]);

            //productions
            $prods = Form1Details::with('weeklyReport')->selectRaw('week_ending, sum(manufactured) as manufacturedTotal')
                ->leftJoin('weekly_reports','weekly_reports.slug','=','weekly_report_slug');
            if(\Auth::user()->access == 'ADMIN'){
                if(Request::has('mill_code') && !empty(Request::get('mill_code'))){
                    $prods = $prods->where('mill_code','=', Request::get('mill_code'));
                }
            }else{
                $prods = $prods->where('mill_code','=', \Auth::user()->mill_code);
            }
            $prods= $prods->groupBy('week_ending')
                ->get();
            foreach ($prods as $prod){
                if(isset($weekStructure[Carbon::parse($prod->week_ending)->format('Ymd')])){
                    $weekStructure[Carbon::parse($prod->week_ending)->format('Ymd')]['production'] = $prod->manufacturedTotal;
                }
            }
            //withdrawals
            $dels = Deliveries::query()->selectRaw('week_ending, sum(qty) as deliveryTotal')
                ->leftJoin('weekly_reports','weekly_reports.slug','=','weekly_report_slug');
            if(Request::has('mill_code') && !empty(Request::get('mill_code'))){
                $dels = $dels->where('mill_code','=', Request::get('mill_code'));
            }
            $dels = $dels->groupBy('week_ending')
                ->get();
            foreach ($dels as $del){
                if(isset($weekStructure[Carbon::parse($del->week_ending)->format('Ymd')])){
                    $weekStructure[Carbon::parse($del->week_ending)->format('Ymd')]['withdrawals'] = $del->deliveryTotal;
                }
            }
            foreach ($weekStructure as $key => $val){
                $weekStructure[$key]['label'] = date('M. d, Y',strtotime($key));
            }
             $retArray = [
                 'pVsC' => [
                    'labels' => array_column($weekStructure,'label'),
                    'data' => [
                        'productions' => array_column($weekStructure,'production'),
                        'withdrawals' => array_column($weekStructure,'withdrawals'),
                    ]
                ]
            ];

         
            $weekStructure = $this->weekStructure('2022-2023',Carbon::now(),[
                'wholesale_raw' => 0,
                'wholesale_refined' =>0,
                'retail_raw' => 0,
                'retail_refined' =>0,
            ]);

            $form1 = Form1Details::query()
                ->selectRaw('week_ending, avg(wholesale_raw) as wholesale_raw, avg(wholesale_refined) as wholesale_refined, avg(retail_raw) as retail_raw, avg(retail_refined) as retail_refined')
                ->leftJoin('weekly_reports','weekly_reports.slug','=','form1_details.weekly_report_slug');
            if(Request::has('mill_code') && !empty(Request::get('mill_code'))){
                $form1 = $form1->where('mill_code','=', Request::get('mill_code'));
            }
            $form1 = $form1->groupBy('week_ending')
                ->get();

            foreach ($form1 as $data){
                if(isset($weekStructure[Carbon::parse($data->week_ending)->format('Ymd')])){
                    $weekStructure[Carbon::parse($data->week_ending)->format('Ymd')]['wholesale_raw'] = $data->wholesale_raw ?? 0;
                    $weekStructure[Carbon::parse($data->week_ending)->format('Ymd')]['wholesale_refined'] = $data->wholesale_refined ?? 0;
                    $weekStructure[Carbon::parse($data->week_ending)->format('Ymd')]['retail_raw'] = $data->retail_raw ?? 0;
                    $weekStructure[Carbon::parse($data->week_ending)->format('Ymd')]['retail_refined'] = $data->retail_refined ?? 0;
                }
            }

            $retArray['prices'] = [
                'labels' => array_column($weekStructure,'label'),
                'data' => [
                    'wholesale_raw' => array_column($weekStructure,'wholesale_raw'),
                    'wholesale_refined' => array_column($weekStructure,'wholesale_refined'),
                    'retail_raw' => array_column($weekStructure,'retail_raw'),
                    'retail_refined' => array_column($weekStructure,'retail_refined'),
                ]
            ];


            return $retArray;

        }

        if($for == 'productionByGeogLoc') {
            $prods = \DB::table('sugar_mills as sm')
                ->selectRaw('sm.slug as mill_code, geog_location, sum(manufactured) as RAW,
                            sum(ifnull(prodDomestic,0)) + sum(ifnull(prodImported,0)) + sum(ifnull(prodReturn,0)) as REFINED,
                            sum(ifnull(manufacturedRaw,0)) + sum(ifnull(rao,0)) + sum(ifnull(manufacturedRefined,0)) as MOLASSES')
                ->leftJoin('weekly_reports as wr', 'wr.mill_code', '=', 'sm.slug')
                ->leftJoin('form1_details as form1', 'form1.weekly_report_slug', '=', 'wr.slug')
                ->leftJoin('form2_details as form2', 'form2.weekly_report_slug', '=', 'wr.slug')
                ->leftJoin('form3_details as form3', 'form3.weekly_report_slug', '=', 'wr.slug')
                ->groupBy('sm.geog_location')
                ->get();
            $prodsArr = [];
            $finalArr = ['RAW' => [], 'REFINED' => [], 'MOLASSES' => []];
            if (!empty($prods)) {
                foreach ($prods as $prod) {
                    $prodsArr[$prod->geog_location]['RAW'] = $prod->RAW;
                    $prodsArr[$prod->geog_location]['REFINED'] = $prod->REFINED;
                    $prodsArr[$prod->geog_location]['MOLASSES'] = $prod->MOLASSES;
                }
                ksort($prodsArr);
                foreach ( $prodsArr as $loc => $prodArr){
                    $finalArr['RAW'][$loc] = $prodArr['RAW'];
                    $finalArr['REFINED'][$loc] = $prodArr['REFINED'];
                    $finalArr['MOLASSES'][$loc] = $prodArr['MOLASSES'];
                }
            }
            $finalArr['RAW'] = array_values($finalArr['RAW']);
            $finalArr['REFINED'] = array_values($finalArr['REFINED']);
            $finalArr['MOLASSES'] = array_values($finalArr['MOLASSES']);
            return $finalArr;

        }

        if($for == 'chartAdminPriceFluctuation'){


        }

        if($for == 'form1Issuance'){
            return view('sms.dynamic_rows.form1Issuances');
        }

        if($for == 'form4InsertWarehouse'){

            $request = \request();
            return view('sms.dynamic_rows.form4InsertWarehouse')->with([
                'transactionType' => $request->get('transactionType'),
                'sugarType' => $request->get('sugarType'),
            ]);
        }

        if($for == 'myWarehouses'){
            $request = \request();
            $whs = Warehouses::query()
                ->where(function($query) use($request){
                    $query->where('alias','like','%'.$request->get('q').'%')
                        ->orWhere('name','like','%'.$request->get('q').'%');
                })
                ->where('millCode','=',\Auth::user()->mill_code)
                ->where('for','=',$request->get('for'))
                ->limit(10)
                ->get();
            $results = [];

            if(!empty($whs)){
                foreach ($whs as $wh){

                    array_push($results,[
                        'id' => $wh->alias,
                        'text' => $wh->alias.' | '.$wh->name,
                    ]);
                }
            }
            return [
                'results' => $results,
            ];
        }


        if($for == 'traderListing'){
            $mill_code = Auth::user()->mill_code;
            $form5issuance = IssuancesOfSro::query()->select('trader')
                ->whereHas('weeklyReport',function ($q) use ($mill_code){
                   return $q->where('mill_code','=',$mill_code);
                });
            $form5aissuance = \App\Models\SMS\Form5a\IssuancesOfSro::query()->select('trader')
                ->whereHas('weeklyReport',function ($q) use ($mill_code){
                    return $q->where('mill_code','=',$mill_code);
                });

            $form5delivery = Deliveries::query()->select('trader')
                ->whereHas('weeklyReport',function ($q) use ($mill_code){
                    return $q->where('mill_code','=',$mill_code);
                });

            $form5adelivery = \App\Models\SMS\Form5a\Deliveries::query()->select('trader')
                ->whereHas('weeklyReport',function ($q) use ($mill_code){
                    return $q->where('mill_code','=',$mill_code);
                });

            $form3bissuance = IssuancesOfMro::query()->select('trader')
                ->whereHas('weeklyReport',function ($q) use ($mill_code){
                    return $q->where('mill_code','=',$mill_code);
                });

            $form3bdelivery = \App\Models\SMS\Form3b\Deliveries::query()->select('trader')
                ->whereHas('weeklyReport',function ($q) use ($mill_code){
                    return $q->where('mill_code','=',$mill_code);
                });

            $form5issuance = $form5issuance->union($form5aissuance)
                ->union($form5delivery)
                ->union($form5adelivery)
                ->union($form3bissuance)
                ->union($form3bdelivery)
                ->orderBy('trader','asc')
                ->get();
            $arr = [];
            if(!empty($form5issuance)){
                foreach ($form5issuance as $data){
                    array_push($arr,$data->trader);
                }
            }
            return view('sms.weekly_report.ajax.datalist.traders')->with([
                'traders' => $arr,
            ]);
        }

        if($for == 'seriesNos'){
            return view('sms.dynamic_rows.insertSeriesNos')->with([
                'for' => \request('for'),
            ]);
        }


        return view('sms.dynamic_rows.'.$for);
    }


    public function weekStructure($cy = null,$limiter = null, $data = []){
        if($cy == null){
            $cy = '2022-2023';
        }
        if($limiter == null) {
            $limiter = Carbon::now()->format('Y-m-d');
        }
        $limiter = Carbon::parse($limiter)->format('Y-m-d');
        $c = CropYears::query()->where('name','=',$cy)->first();
        $week1 = Carbon::parse($c->week1);


        $weekStructure = [];
        while ($week1->format('Ymd') <= Carbon::parse($limiter)->format('Ymd')){
            $week1 = $week1->addDays(7);
            $weekStructure[$week1->format('Ymd')] = $data;
            $weekStructure[$week1->format('Ymd')]['label'] = $week1->format('M. d, Y');
        }

        return $weekStructure;
    }

}