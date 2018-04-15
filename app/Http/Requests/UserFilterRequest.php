<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFilterRequest extends FormRequest{

    
    public function authorize(){

        return true;
    }

   
    public function rules(){

        return [

            'ol' => 'nullable|string',
            'a' => 'nullable|string',

        ];

    }


    public function messages(){

        return [

            'ol.string'  => 'Invalid input, must be a string!',
            'a.string'  => 'Invalid input, must be a string!',

        ];

    }



}
