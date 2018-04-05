<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisbursementVoucherFormRequest extends FormRequest{


    
    public function authorize(){
        
        return true;
    
    }



    
    public function rules(){

        return [

            'project_id'=>'required|string|min:4|max:4',
            'fund_source'=>'required|string|min:4|max:4',
            'mode_of_payment'=>'nullable|string|min:4|max:4',
            'payee'=>'required|string|max:90',
            'tin'=>'required|string|max:20',
            'bur_no'=>'nullable|string|max:20',
            'address'=>'required|string|max:200',
            'department_name'=>'required|string|max:45',
            'department_unit_name'=>'nullable|string|max:45',
            'account_code'=>'required|string|max:45',
            'explanation'=>'required',
            'amount'=>'required|string|max:20'

        ];

    }





    public function messages(){

        return [

            'project_id.required'  => 'Station field is required.',
            'project_id.string'  => 'Invalid Input! You must enter a string value.',
            'project_id.min'  => 'The Station field may not be lesser than 4 characters.',
            'project_id.max'  => 'The Station field may not be greater than 4 characters.',

            'fund_source.required'  => 'Fund Source field is required.',
            'fund_source.string'  => 'Invalid Input! You must enter a string value.',
            'fund_source.min'  => 'The Fund Source field may not be lesser than 4 characters.',
            'fund_source.max'  => 'The Fund Source field may not be greater than 4 characters.',

            'mode_of_payment.string'  => 'Invalid Input! You must enter a string value.',
            'mode_of_payment.min'  => 'The Mode Of Payment field may not be lesser than 4 characters.',
            'mode_of_payment.max'  => 'The Mode Of Payment field may not be greater than 4 characters.',

            'payee.required'  => 'Payee field is required.',
            'payee.string'  => 'Invalid Input! You must enter a string value.',
            'payee.max'  => 'The Payee field may not be greater than 90 characters.',

            'tin.required'  => 'TIN/Employee No. field is required.',
            'tin.string'  => 'Invalid Input! You must enter a string value.',
            'tin.max'  => 'The TIN/Employee No. field may not be greater than 20 characters.',

            'bur_no.string'  => 'Invalid Input! You must enter a string value.',
            'bur_no.max'  => 'The BUR No. field may not be greater than 20 characters.',

            'address.required'  => 'Address field is required.',
            'address.string'  => 'Invalid Input! You must enter a string value.',
            'address.max'  => 'The Address field may not be greater than 200 characters.',

            'department_name.required'  => 'Department field is required.',
            'department_name.string'  => 'Invalid Input! You must enter a string value.',
            'department_name.max'  => 'The Department field may not be greater than 45 characters.',

            'department_unit_name.string'  => 'Invalid Input! You must enter a string value.',
            'department_unit_name.max'  => 'The Unit field may not be greater than 45 characters.',

            'account_code.required'  => 'Account Code field is required.',
            'account_code.string'  => 'Invalid Input! You must enter a string value.',
            'account_code.max'  => 'The Account Code field may not be greater than 45 characters.',

            'explanation.required'  => 'Explanation field is required.',

            'amount.required'  => 'Amount field is required.',
            'amount.string'  => 'Invalid Input! You must enter a string value.',
            'amount.max'  => 'The Amount field may not be greater than 20 characters.',


        ];

    }





}
