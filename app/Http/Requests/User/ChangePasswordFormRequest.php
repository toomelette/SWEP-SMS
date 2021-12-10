<?php


namespace App\Http\Requests\User;


use App\Rules\CurrentPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordFormRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'password' => 'required|confirmed|not_in:123456',
            'password_confirmation' => 'required',
            'user_password' => [
                'required',
                new CurrentPassword(),
            ],
        ];
    }
    public function messages()
    {
        return [
            'password.confirmed' => 'Password confirmation does not match.',
            'password.not_in' => 'Too simple',
        ];
    }
}

