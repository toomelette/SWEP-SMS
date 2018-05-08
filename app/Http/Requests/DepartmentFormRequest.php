<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentFormRequest extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            'name' => 'required|max:45|string',
        ];

    }




    public function messages(){

        return [

            'name.required'  => 'Name field is required.',
            'name.max'  => 'The Name field exceeded the maximum characters.',
            'name.string'  => 'Invalid Input! You must enter a string value.',

        ];

    }



}
