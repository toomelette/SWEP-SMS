<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UserFormRequest extends FormRequest{

    
    public function authorize(){

        return true;
    }

    
    public function rules(){
        
        return [
            
            'firstname'=>'required|string|max:90',
            'middlename'=>'required|string|max:90',
            'lastname'=>'required|string|max:90',
            'email'=>'required|string|email|max:90',
            'position'=>'required|string|max:90',
            'username'=>'required|string|max:45',
            'password'=>'required|min:6|max:50|string|confirmed',

        ];

    }


     public function messages(){

        return [

            'firstname.required'  => 'Firstname field is required.',
            'firstname.string'  => 'Invalid Input! You must enter a string value.',
            'firstname.max'  => 'The Firstname field may not be greater than 90 characters.',

            'middlename.required'  => 'Middlename field is required.',
            'middlename.string'  => 'Invalid Input! You must enter a string value.',
            'middlename.max'  => 'The Middlename field may not be greater than 90 characters.',

            'lastname.required'  => 'Lastname field is required.',
            'lastname.string'  => 'Invalid Input! You must enter a string value.',
            'lastname.max'  => 'The Lastname field may not be greater than 90 characters.',

            'email.required'  => 'Email field is required.',
            'email.email'  => 'Invalid Input! You must enter a valid email.',
            'email.string'  => 'Invalid Input! You must enter a string value.',
            'email.max'  => 'The Email field may not be greater than 90 characters.',

            'position.required'  => 'Position field is required.',
            'position.string'  => 'Invalid Input! You must enter a string value.',
            'position.max'  => 'The Position field may not be greater than 90 characters.',

            'username.required'  => 'Username field is required.',
            'username.string'  => 'Invalid Input! You must enter a string value.',
            'username.max'  => 'The Username field may not be greater than 45 characters.',

            'password.required'  => 'Password field is required.',
            'password.confirmed'  => 'The Password Confirmation does not match.',
            'password.string'  => 'Invalid Input! You must enter a string value.',
            'password.min'  => 'The Password field may not be lesser than 6 characters.',
            'password.max'  => 'The Password field may not be greater than 50 characters.',

        ];

    }



}
