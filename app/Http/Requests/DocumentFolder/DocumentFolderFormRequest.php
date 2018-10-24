<?php

namespace App\Http\Requests\DocumentFolder;

use Illuminate\Foundation\Http\FormRequest;

class DocumentFolderFormRequest extends FormRequest{
    



    public function authorize(){
        
        return true;
    
    }

    



    public function rules(){

        return [

            'folder_code' => 'required|max:45|string',
            'description' => 'nullable|max:255|string',
            
        ];
    
    }





}
