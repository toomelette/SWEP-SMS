<?php

namespace App\Http\Requests\EmployeeTraining;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeTrainingPrintFilterForm extends FormRequest{



   
    public function authorize(){

        return true;
    
    }
    




    public function rules(){

        return [

            'df'=>'nullable|date_format:"Y-m-d"',
            'dt'=>'nullable|date_format:"Y-m-d"',
        
        ];
    
    }




}
