<?php


namespace App\Http\Requests\Employee;


use Illuminate\Foundation\Http\FormRequest;

class EligibilityFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        if($this->getMethod() == 'POST'){
            $s = 'required|string';
        }else{
            $s = 'nullable|string';
        }
        return [
            'employee_no' => $s,
            'eligibility' => 'required|string|max:255',
            'level' => 'nullable|string|max:20',
            'rating' => 'nullable|numeric',
            'exam_place' => 'nullable|string|max:255',
            'exam_date' => 'nullable|date',
            'license_no' => 'nullable|string|max:90',
            'license_validity' => 'nullable|date',
        ];
    }
}