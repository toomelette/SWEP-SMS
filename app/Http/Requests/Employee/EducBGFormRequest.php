<?php


namespace App\Http\Requests\Employee;


use Illuminate\Foundation\Http\FormRequest;

class EducBGFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'level' => 'required|string|max:25',
            'school_name' => 'required|string|max:255',
            'course' => 'nullable|string|max:90',
            'date_from' => 'nullable|string|max:45',
            'date_to' => 'nullable|string|max:45',
            'units' => 'nullable|integer|max:100',
            'graduate_year' => 'nullable|string|max:45',
            'scholarship' => 'nullable|string|max:90',
            'honor' => 'nullable|string|max:90',
        ];
    }
}