<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateAccountPasswordRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    



     public function rules(){

        return [

            'old_password' => 'required|max:45|string',
            'password' => 'required|min:6|max:45|string|confirmed'

        ];

    }




    public function messages(){

        return [
        	
        	'old_password.required'  => 'Old Password field is required.',
            'old_password.string'  => 'Invalid Input! You must enter a string value.',
            'password.max'  => 'The Old Password field may not be greater than 45 characters.',

            'password.required'  => 'Password field is required.',
            'password.confirmed'  => 'The Password Confirmation does not match.',
            'password.string'  => 'Invalid Input! You must enter a string value.',
            'password.min'  => 'The Password field may not be lesser than 6 characters.',
            'password.max'  => 'The Password field may not be greater than 45 characters.',

        ];

    }




}
