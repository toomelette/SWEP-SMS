<?php

namespace App\Http\Requests\DisbursementVoucher;

use Illuminate\Foundation\Http\FormRequest;

class DisbursementVoucherSetNoRequest extends FormRequest{

    
    public function authorize(){

        return true;
    }

    
    public function rules(){

        return [
        
            'dv_no' => 'nullable|max:20|string',

        ];

    }



}
