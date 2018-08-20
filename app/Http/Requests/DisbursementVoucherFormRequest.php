<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisbursementVoucherFormRequest extends FormRequest{


    
    public function authorize(){
        
        return true;
    
    }



    
    public function rules(){

        return [

            'project_id'=>'nullable|string|min:5|max:5',
            'fund_source_id'=>'nullable|string|min:6|max:6',
            'mode_of_payment'=>'nullable|string|min:4|max:5',
            'payee'=>'required|string|max:255',
            'tin'=>'nullable|string|max:20',
            'bur_no'=>'nullable|string|max:20',
            'address'=>'nullable|string|max:255',
            'department_name'=>'nullable|string|max:45',
            'department_unit_name'=>'nullable|string|max:45',
            'project_code'=>'nullable|string|max:45',
            'explanation'=>'required',
            'amount'=>'required|string|max:13'

        ];

    }




}
