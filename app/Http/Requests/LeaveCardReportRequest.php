<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveCardReportRequest extends FormRequest{
    



    public function authorize(){

        return true;
    
    }


    public function rules(){

        return [

            'r_type' => 'required|string|max:10',
            'm' => 'sometimes|required|string|max:5',
            'y' => 'sometimes|required|integer|max:3000|min:2000',
            'emp' => 'sometimes|required|string|max:10',
            
        ];
    
    }




}
