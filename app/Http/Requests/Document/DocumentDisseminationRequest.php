<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class DocumentDisseminationRequest extends FormRequest{




    
    public function authorize(){

        return true;
    
    }





    public function rules(){

        return [
            
        ];
    
    }



}
