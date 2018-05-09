<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentUnitFormRequest extends FormRequest{


    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [

            'department_id' => 'required|max:5|string',
            'department_name' => 'required|max:45|string',
            'name' => 'required|max:45|string',
            'description' => 'required|max:90|string',
        
        ];

    }




    public function messages(){

        return [

            'department_id.required'  => 'Department field is required.',
            'department_id.max'  => 'The Department field exceeded the maximum characters required.',
            'department_id.string'  => 'Invalid Input! You must enter a string value.',

            'name.required'  => 'Name field is required.',
            'name.max'  => 'The Name field exceeded the maximum characters required.',
            'name.string'  => 'Invalid Input! You must enter a string value.',

            'description.required'  => 'Description field is required.',
            'description.max'  => 'The Description field exceeded the maximum characters required.',
            'description.string'  => 'Invalid Input! You must enter a string value.',

        ];

    }



}
