<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentFilterRequest extends FormRequest{
    





    public function authorize(){

        return true;
    
    }

    



    public function rules(){

        return [
            
            'q' => 'nullable|string|max:255',
            'd' => 'nullable|date_format:"m/d/Y"',
            'fc' => 'nullable|string|max:45',
            'dt' => 'nullable|string|max:45',
            
        ];
    
    }





}
