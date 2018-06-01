<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentFilterRequest extends FormRequest{



    public function authorize(){

        return true;
    }

   


    public function rules(){

        return [

            'q' => 'nullable|string|max:90',

        ];

    }




    public function messages(){

        return [
            
            'q.string'  => 'Invalid input, must be a string!',
            'q.max'  => 'The User Status field may not be greater than 5 characters.',

        ];

    }



}
