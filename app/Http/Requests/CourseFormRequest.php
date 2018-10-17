<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseFormRequest extends FormRequest{



   
    public function authorize(){

        return true;
    
    }

    



    public function rules(){

        return [

            'acronym' => 'nullable|max:11|string',
            'name' => 'required|max:255|string',
            
        ];
    
    }




}
