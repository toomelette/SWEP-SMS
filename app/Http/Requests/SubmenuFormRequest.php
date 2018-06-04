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






}
