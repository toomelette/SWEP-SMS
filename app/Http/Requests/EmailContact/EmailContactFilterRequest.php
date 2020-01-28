<?php

namespace App\Http\Requests\EmailContact;

use Illuminate\Foundation\Http\FormRequest;

class EmailContactFilterRequest extends FormRequest{



    public function authorize(){

        return true;
    
    }

    



    public function rules(){

        return [

            'q' => 'nullable|string|max:90',
            
        ];

    }




}
