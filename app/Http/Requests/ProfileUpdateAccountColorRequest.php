<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateAccountColorRequest extends FormRequest{




    public function authorize(){
        
        return true;
    
    }



    public function rules(){

        return [

            'color' => 'required|max:45|string',

        ];

    }




    public function messages(){

        return [

            'color.required'  => 'Username field is required.',
            'color.string'  => 'Invalid Input! You must enter a string value.',
            'color.max'  => 'The Username field may not be greater than 45 characters.',

        ];

    }



}
