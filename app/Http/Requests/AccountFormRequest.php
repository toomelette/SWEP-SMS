<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountFormRequest extends FormRequest{
    
    



    public function authorize(){

        return true;
    
    }

    



    public function rules(){

        return [

            'department_id' => 'required|max:5|min:5|string',
            'department_name' => 'required|max:45|string',
            'account_code' => 'required|max:45|string',
            'description' => 'required|max:90|string',
            'mooe'=>'nullable|string|max:13',
            'co' => 'nullable|string|max:13',
            'date_started' => 'nullable|date_format:"m/d/Y"',
            'projected_date_end' => 'nullable|date_format:"m/d/Y"',
            'project_in_charge' => 'nullable|max:90|string',

        ];

    }




    public function messages(){

        return [

            'department_id.required'  => 'Department field is required.',
            'department_id.max'  => 'The Department field may not be greater than 5 characters.',
            'department_id.min'  => 'The Department field may not be lesser than 5 characters.',
            'department_id.string'  => 'Invalid Input! You must enter a string value.',

            'account_code.required'  => 'Account Code field is required.',
            'account_code.max'  => 'The Account Code field may not be greater than 45 characters.',
            'account_code.string'  => 'Invalid Input! You must enter a string value.',

            'description.required'  => 'Description field is required.',
            'description.max'  => 'The Description field may not be greater than 90 characters.',
            'description.string'  => 'Invalid Input! You must enter a string value.',

            'mooe.required'  => 'MOOE field is required.',
            'mooe.string'  => 'Invalid Input! You must enter a string value.',
            'mooe.max'  => 'The MOOE field may not be greater than 13 characters.',

            'co.required'  => 'CO field is required.',
            'co.string'  => 'Invalid Input! You must enter a string value.',
            'co.max'  => 'The CO field may not be greater than 13 characters.',

            'date_started.date_format'  => 'Invalid Format! The Date does not match the format mm/dd/yy',

            'projected_date_end.date_format'  => 'Invalid Format! The Date does not match the format mm/dd/yy',

            'project_in_charge.max'  => 'The Project Incharge field may not be greater than 90 characters.',
            'project_in_charge.string'  => 'Invalid Input! You must enter a string value.',


        ];

    }




}
