<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmenuFormRequest extends FormRequest{



    
    public function authorize(){

        return true;
    
    }

    



    public function rules(){

        return [

            'name' => 'required|max:45|string',
            'route' => 'required|max:45|string',
            'is_nav' => 'required|string|max:5',

        ];

    }




    public function messages(){

        return [

            'name.required'  => 'Name field is required.',
            'name.string'  => 'Invalid Input! You must enter a string value.',
            'name.max'  => 'The Name field may not be greater than 45 characters.',

            'route.required'  => 'Route field is required.',
            'route.string'  => 'Invalid Input! You must enter a string value.',
            'route.max'  => 'The Route field may not be greater than 45 characters.',

            'is_nav.required'  => 'Is nav field is required.',
            'is_nav.string'  => 'Invalid Input! You must enter a string value.',
            'is_nav.max'  => 'The Is nav field may not be greater than 5 characters.',

        ];

    }



}
