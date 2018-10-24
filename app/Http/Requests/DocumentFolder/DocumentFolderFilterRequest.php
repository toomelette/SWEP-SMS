<?php

namespace App\Http\Requests\DocumentFolder;

use Illuminate\Foundation\Http\FormRequest;

class DocumentFolderFilterRequest extends FormRequest{



    public function authorize(){

        return true;
    
    }

    



    public function rules(){

        return [

            'q' => 'nullable|string|max:90',
            
        ];

    }




}
