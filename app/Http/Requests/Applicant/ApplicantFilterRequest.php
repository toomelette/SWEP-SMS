<?php

namespace App\Http\Requests\Applicant;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantFilterRequest extends FormRequest{
    



    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'q' => 'nullable|string|max:90',
            'c' => 'nullable|string|max:10',
            'p' => 'nullable|string|max:10',
            'g' => 'nullable|string|max:10',
            
        ];
    
    }



}
