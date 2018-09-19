<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeFilterRequest extends FormRequest{



    public function authorize(){

        return true;
    }

   


    public function rules(){

        return [

            'q' => 'nullable|string|max:90',
            'd' => 'nullable|string|max:6|min:5',
            'a' => 'nullable|string|max:10|min:5',

        ];

    }



    
}
