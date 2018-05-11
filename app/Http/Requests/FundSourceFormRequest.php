<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FundSourceFormRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    
    public function rules(){

        return [
            'description' => 'required|max:90|string',
        ];

    }




    public function messages(){

        return [

            'description.required'  => 'Description field is required.',
            'description.max'  => 'The Description field exceeded the maximum characters.',
            'description.string'  => 'Invalid Input! You must enter a string value.',

        ];

    }



}
