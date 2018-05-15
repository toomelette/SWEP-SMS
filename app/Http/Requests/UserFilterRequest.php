<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFilterRequest extends FormRequest{

    
    public function authorize(){

        return true;
    }

   
    public function rules(){

        return [

            'ol' => 'nullable|string|max:5',
            'a' => 'nullable|string|max:5',

        ];

    }


    public function messages(){

        return [

            'ol.string'  => 'Invalid input, must be a string!',
            'ol.max'  => 'The Login Status field may not be greater than 5 characters.',

            'a.string'  => 'Invalid input, must be a string!',
            'a.max'  => 'The User Status field may not be greater than 5 characters.',

        ];

    }



}
