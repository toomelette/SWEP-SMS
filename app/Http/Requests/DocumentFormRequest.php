<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentFormRequest extends FormRequest{
    



    public function authorize(){

        return true;
    
    }






    public function rules(){

        return [
                
            'doc_file' => 'nullable|mimes:pdf|max:50000',
            'reference_no' => 'required|max:45|string',
            'date' => 'required|date_format:"m/d/Y"',
            'person_to' => 'required|max:90|string',
            'person_from' => 'required|max:90|string',
            'type' => 'required|max:45|string',
            'subject' => 'required|max:255|string',
            'folder_code' => 'required|max:45|string',
            'remarks' => 'nullable|max:255|string',

        ];
    
    }





}
