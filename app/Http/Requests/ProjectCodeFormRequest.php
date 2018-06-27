<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectCodeFormRequest extends FormRequest{
    
    



    public function authorize(){

        return true;
    
    }

    



    public function rules(){

        return [

            'department_id' => 'required|max:5|min:5|string',
            'department_name' => 'required|max:45|string',
            'project_code' => 'required|max:45|string',
            'description' => 'required|max:255|string',
            'mooe'=>'nullable|string|max:13',
            'co' => 'nullable|string|max:13',
            'date_started' => 'nullable|date_format:"m/d/Y"',
            'projected_date_end' => 'nullable|date_format:"m/d/Y"',
            'project_in_charge' => 'nullable|max:90|string',

        ];

    }






}
