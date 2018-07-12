<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeTrainingCreateForm extends FormRequest{
    



    public function authorize(){
        return true;
    }

    


    public function rules(){
        return [
            
        ];
    }




}
