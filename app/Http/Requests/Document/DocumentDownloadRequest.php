<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class DocumentDownloadRequest extends FormRequest{
    





    public function authorize(){

        return true;
    
    }

    



    public function rules(){

        return [
            
            'y' => 'required|numeric|max:3000',
            'fc' => 'nullable|string|max:45',
            
        ];
    
    }





}
