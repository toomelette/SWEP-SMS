<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserResetPasswordRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }



    public function rules(){

        return [

            'username' => 'required|max:50|string|',
            'user_password' => 'required|max:50|string|',
            'password' => 'required|min:6|max:50|string|confirmed'

        ];

    }



    public function messages(){

        return [

            'password.required'  => 'Password field is required.',
            'password.confirmed'  => 'The Password Confirmation does not match.',
            'password.string'  => 'Invalid Input! You must enter a string value.',
            'password.min'  => 'The Password field may not be lesser than 6 characters.',
            'password.max'  => 'The Password field may not be greater than 50 characters.',

        ];

    }
    


}
