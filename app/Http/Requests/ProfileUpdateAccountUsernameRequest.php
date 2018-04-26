<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateAccountUsernameRequest extends FormRequest{


   
    public function authorize(){

        return true;
    
    }

    



    public function rules(){

        return [

            'username' => 'required|max:45|string|unique:users',

        ];

    }




    public function messages(){

        return [

        	'username.required'  => 'Username field is required.',
            'username.string'  => 'Invalid Input! You must enter a string value.',
            'username.max'  => 'The Username field may not be greater than 45 characters.',

        ];

    }



}
