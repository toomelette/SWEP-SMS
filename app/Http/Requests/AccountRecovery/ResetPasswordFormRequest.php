<?php


namespace App\Http\Requests\AccountRecovery;


use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordFormRequest extends FormRequest
{

        public function authorize(){
            return true;
        }

        public function rules(){
            return [
                'username' => 'required|string|exists:users,username',
            ];
        }

        public function messages()
        {
            return [
                'username.exists' => 'This username does not exist',
            ];
        }
}