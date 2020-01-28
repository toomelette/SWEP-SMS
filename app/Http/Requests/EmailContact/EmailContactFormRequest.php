<?php

namespace App\Http\Requests\EmailContact;

use Illuminate\Foundation\Http\FormRequest;

class EmailContactFormRequest extends FormRequest{
    



    public function authorize(){
        
        return true;
    
    }

    



    public function rules(){

        return [

            'name' => 'required|max:255|string',
            'email' => 'required|max:90|email',
            'contact_no' => 'nullable|max:45|string',
            
        ];
    
    }





}
