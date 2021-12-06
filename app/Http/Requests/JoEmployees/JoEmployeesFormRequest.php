<?php


namespace App\Http\Requests\JoEmployees;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JoEmployeesFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'firstname' => 'required|string|max:254',
            'middlename' => 'nullable|string|max:254',
            'lastname' => 'required|string|max:254',
            'name_ext' => 'nullable|string|max:254',
            'civil_status' => 'required|string|max:254',
            'birthday' => 'required|date_format:"Y-m-d"',
            'sex' => 'required|string|max:10|in:MALE,FEMALE',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:254',

            'employee_no' => [
                'required',
                'string',
                'max:254',
                Rule::unique('hr_jo_employees','employee_no')->ignore($this->slug,'slug'),
                Rule::unique('hr_employees'),
            ],
            'department_unit' => 'required|string|max:254|exists:su_department_units,department_unit_id',
            'position' => 'nullable|string|max:254',
            'biometric_user_id' => [
                'required',
                'string',
                'max:10',
                Rule::unique('hr_jo_employees','biometric_user_id')->ignore($this->slug,'slug'),
                Rule::unique('hr_employees','biometric_user_id'),
            ],
            'province' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'brgy' => 'nullable|string|max:255',
            'address_detailed' => 'nullable|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users','username')->ignore($this->employee_no,'employee_no'),
            ],
        ];
    }
}