<?php


namespace App\Http\Controllers\SMS\WeeklyReport;


use App\Http\Controllers\Controller;
use App\Http\Requests\SMS\Form1Request;
use Illuminate\Http\Request;

class Form1Controller extends Controller
{
    public function store(Form1Request $request){
        return $request;
        $request_array = $request->toArray();
        $children = [];

        //issuances
        if(!empty($request->issuances_option)){
            foreach ($request->issuances_option as $key => $i){
                array_push($children,[
                    'input_field' => $request->issuances_option[$key],
                    'cur_value' => $request->issuances[$key],
                    'prev_value' => $request->prev_issuances[$key],
                ]);
            }

        }
        //withdrawals
        if(!empty($request->withdrawals_option)){
            foreach ($request->withdrawals_option as $key => $i){
                array_push($children,[
                    'input_field' => $request->withdrawals_option[$key],
                    'cur_value' => $request->withdrawals[$key],
                    'prev_value' => $request->prev_withdrawals[$key],
                ]);
            }
        }
        //balance
        if(!empty($request->balance_option)){
            foreach ($request->balance_option as $key => $i){
                array_push($children,[
                    'input_field' => $request->balance_option[$key],
                    'cur_value' => $request->balance[$key],
                    'prev_value' => $request->prev_balance[$key],
                ]);
            }
        }
        return $children;

    }

    private function masterFields(){
        return [
            'crop_year','week_ending','report_no','dist_no', '_token',
        ];
    }
}