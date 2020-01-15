<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class DocumentDisseminationRequest extends FormRequest{




    
    public function authorize(){

        return true;
    
    }





    public function rules(){

        $rules = [

            'type'=>'required|string|max:1',
        	'employee'=>'nullable|array',
            'department_unit'=>'nullable|array',
            'subject'=>'required|string|max:255',
            'content'=>'nullable|string|max:255',

        ];

        if(!empty($this->request->get('employee'))){
            foreach($this->request->get('employee') as $key => $value){
                $rules['employee.'.$key] = 'string|max:45';
            } 
        }

        if(!empty($this->request->get('department_unit'))){
            foreach($this->request->get('department_unit') as $key => $value){
                $rules['department_unit.'.$key] = 'string|max:45';
            } 
        }

        return $rules;

    }



}
