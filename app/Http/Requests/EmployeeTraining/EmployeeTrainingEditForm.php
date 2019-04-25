<?php

namespace App\Http\Requests\EmployeeTraining;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeTrainingEditForm extends FormRequest{
    


    public function authorize(){

        return true;
    
    }

    



    public function rules(){

        return [
            
        	'e_title'=>'required|string|max:250',
            'e_type'=>'nullable|string|max:45',
            'e_date_from'=>'nullable|date_format:"m/d/Y"',
            'e_date_to'=>'nullable|date_format:"m/d/Y"',
            'e_hours'=>'required|int|max:1000',
            'e_conducted_by'=>'nullable|string|max:250',
            'e_venue'=>'nullable|string|max:250',
            'e_remarks'=>'nullable|string|max:250',
            'e_is_relevant'=>'nullable|string|max:11',

        ];
    
    }




}
