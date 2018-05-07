<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignatoriesFormRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }


    
    public function rules(){

        return [

            'employee_name' => 'required|max:90|string',
            'employee_position' => 'required|max:90|string',
            'type' => 'required|max:20|int',
            
        ];
    
    }



    public function messages(){

        return [

            'employee_name.required'  => 'Name field is required.',
            'employee_name.max'  => 'The Name field may not be greater than 90 characters.',
            'employee_name.string'  => 'Invalid Input! You must enter a string value.',

            'employee_position.required'  => 'Position field is required.',
            'employee_position.max'  => 'The Position field may not be greater than 90 characters.',
            'employee_position.string'  => 'Invalid Input! You must enter a string value.',

            'type.required'  => 'Type field is required.',
            'type.max'  => 'The Type field may not be greater than 20.',
            'type.string'  => 'Invalid Input! You must enter a string value.',

        ];

    }




}
