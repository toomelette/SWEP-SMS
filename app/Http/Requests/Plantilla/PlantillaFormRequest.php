<?php

namespace App\Http\Requests\Plantilla;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlantillaFormRequest extends FormRequest{
   



    public function authorize(){

        return true;
    
    }





    public function rules(){

        return [
            'item_no' => [
                'required',
                'string',
                'max:255',
                Rule::unique('hr_pay_plantilla','item_no')->ignore($this->request->get('id'),'item_no'),
            ],
            'position' => 'required|string|max:255',
            'original_job_grade' => 'required|int|max:50',
            'original_job_grade_si' => 'required|int|max:8',
            'employee_no' => [
                'nullable',
                'string',
                Rule::exists('hr_employees','employee_no'),
            ]
        ];
    
    }




}
