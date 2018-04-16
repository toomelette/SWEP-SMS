<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisbursementVoucherSetNoRequest extends FormRequest{

    
    public function authorize(){

        return true;
    }

    
    public function rules(){

        return [
        
            'dv_no' => 'nullable|max:45|string',

        ];

    }


    public function messages(){

        return [

            'dv_no.string'  => 'Invalid Input! You must enter a string value.',
            'dv_no.max'  => 'The Field may not be greater than 50 characters.',

        ];

    }

}
