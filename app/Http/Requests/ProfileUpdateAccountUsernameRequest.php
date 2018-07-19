<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateAccountUsernameRequest extends FormRequest{


   
    public function authorize(){

        return true;
    
    }

    



    public function rules(){
    	
        return [

            'username' => 'required|max:45|string|unique:users,username',

        ];

    }





}
