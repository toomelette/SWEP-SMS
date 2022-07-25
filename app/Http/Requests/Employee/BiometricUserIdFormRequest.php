<?php


namespace App\Http\Requests\Employee;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BiometricUserIdFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'biometric_user_id' => [
                'required',
                'string',
                'max:10',
                'not_in:0',
                Rule::unique('hr_employees','biometric_user_id')->ignore($this->slug,'slug'),
            ],
        ];
    }
}