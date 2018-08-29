<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentFolderFormRequest extends FormRequest{
    



    public function authorize(){
        
        return true;
    
    }

    



    public function rules(){

        return [
            
        ];
    
    }





}
