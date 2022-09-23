<?php


namespace App\Http\Requests\SMS;


use Illuminate\Foundation\Http\FormRequest;

class Form1Request extends FormRequest
{
    public  function authorize(){
        return true;
    }

    public function rules(){
        return [
//            'children.prev.*' =>  'required',
            'children.*' => 'required',
                //            'children.*' => 'required|string|max:45',
//            'children.prev_manufactured' => 'required|string|max:45',
//            'children.unquedanned' => 'required|string|max:45',
//            'children.prev_unquedanned' => 'required|string|max:45',
//            'children.stock_balance' => 'required|string|max:45',
//            'children.prev_stock_balance' => 'required|string|max:45',

//            'children.issuances_option.*' => 'required|string|max:45',
//            'children.issuances.*' => 'required|string|max:45',
//            'children.withdrawals_option.*' => 'required|string|max:45',
//            'children.withdrawals.*' => 'required|string|max:45',
//            'children.balance_option.*' => 'required|string|max:45',
//            'children.balance.*' => 'required|string|max:45',
//
//            'unquedanned' => 'nullable|string|max:45',

        ];
    }
}