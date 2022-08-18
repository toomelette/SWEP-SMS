<?php

namespace App\Http\Requests\DisbursementVoucher;

use Illuminate\Foundation\Http\FormRequest;

class DisbursementVoucherFormRequest extends FormRequest{


    
    public function authorize(){
        
        return true;
    
    }



    
    public function rules(){

        $rules = [
            'project_id'=>'nullable|string|max:20',
            'fund_source'=>'required|string|max:11',
            'mode_of_payment'=>'required|string|max:11',
            'mode_of_payment_specify' =>'required_if:mode_of_payment,==,OTHERS',
            'payee'=>'required|string|max:255',
            'tin'=>'nullable|string|max:20',
            'bur_no'=>'nullable|string|max:20',
            'address'=>'nullable|string|max:255',
            'department_name'=>'nullable|string|max:45',
            'department_unit_name'=>'nullable|string|max:45',
            'project_code'=>'nullable|string|max:45',
            'explanation'=>'required',
            'amount.*'=>'required|string|max:13',
            'certified_supervisor' => 'required|string|max:35',
            'certified_supervisor_position' => 'required|string|max:35',
            'certified_by' => 'required|string|max:35',
            'certified_by_position' => 'required|string|max:35',
            'approved_by' => 'required|string|max:42',
            'approved_by_position' => 'required|string|max:42',
            'resp_center.*' => 'required',

        ];

        return $rules;
    }




}
