<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemoFilterRequest extends FormRequest{
   




    public function authorize(){

        return true;
    
    }





    public function rules(){

        return [
             'q' => 'nullable|string|max:255',
             'd' => 'date_format:"m/d/Y"|nullable',
        ];

    }






}
