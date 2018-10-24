<?php

namespace App\Http\Requests\Signatory;

use Illuminate\Foundation\Http\FormRequest;

class SignatoryFormRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }


    
    public function rules(){

        return [

            'employee_name' => 'required|max:255|string',
            'employee_position' => 'required|max:90|string',
            'type' => 'required|max:20|int',
            
        ];
    
    }





}
