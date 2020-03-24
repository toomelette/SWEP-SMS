<?php

namespace App\Http\Requests\Applicant;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantReportRequest extends FormRequest{



    
    public function authorize(){

        return true;
    
    }
    


    public function rules(){

        return [

            'r_type' => 'required|string|max:3',
            't' => 'sometimes|string|max:2',
            'du' => 'nullable|string|max:11',
            'c' => 'nullable|string|max:11',
            'from' => 'sometimes|date',
            'to' => 'sometimes|date|after_or_equal:from',
            
        ];

    }



}
