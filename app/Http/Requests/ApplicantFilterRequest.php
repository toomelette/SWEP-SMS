<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantFilterRequest extends FormRequest{
    



    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            
            
        ];
    
    }



}
