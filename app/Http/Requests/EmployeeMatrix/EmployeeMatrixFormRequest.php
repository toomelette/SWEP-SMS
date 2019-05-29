<?php

namespace App\Http\Requests\EmployeeMatrix;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeMatrixFormRequest extends FormRequest{



    
    public function authorize(){

        return true;

    }




    public function rules(){

        return [
            
        ];
    
    }




}
