<?php


namespace App\Http\Requests\Employee;


use Illuminate\Foundation\Http\FormRequest;

class WorkExperienceFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        if($this->getMethod() == 'POST'){
            $v = 'required|string|max:20';
        }else{
            $v = 'nullable|string|max:20';
        }
        return [
            'employee_no' => $v,
            'date_from' => 'nullable|date_format:Y-m-d',
            'date_to' => 'nullable|date_format:Y-m-d',
            'position' => 'required|string|max:90',
            'company' => 'required|string|max:255',
            'salary' => 'nullable|string',
            'salary_grade' => 'nullable|int',
            'step' => 'nullable|int',
            'appointment_status' => 'nullable|string|max:45',
            'is_gov_service' => 'nullable|int|max:1',
        ];
    }
}