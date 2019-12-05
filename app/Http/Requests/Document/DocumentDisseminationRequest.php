<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class DocumentDisseminationRequest extends FormRequest{




    
    public function authorize(){

        return true;
    
    }





    public function rules(){

        $rules = [

        	'employee'=>'required|array|min:1',
            'subject'=>'required|string|max:255',
            'content'=>'nullable|string|max:255',

        ];

        if(!empty($this->request->get('employee'))){
            foreach($this->request->get('employee') as $key => $value){
                $rules['employee.'.$key] = 'string|max:45';
            } 
        }

        return $rules;

    }



}
