<?php

namespace App\Http\Requests\DepartmentUnit;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentUnitFormRequest extends FormRequest{


    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [

            'department_id' => 'required|max:5|min:5|string',
            'department_name' => 'required|max:45|string',
            'name' => 'required|max:45|string',
            'description' => 'required|max:90|string',
        
        ];

    }




}
