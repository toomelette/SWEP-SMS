<?php

namespace App\Http\Requests\LeaveApplication;

use Illuminate\Foundation\Http\FormRequest;

class LeaveApplicationFilterRequest extends FormRequest{



    public function authorize(){

        return true;
    }

   


    public function rules(){

        return [

            'q' => 'nullable|string|max:90',
            't' => 'nullable|string|max:11',
            'df' => 'nullable|date_format:"m/d/Y"',
            'dt' => 'nullable|date_format:"m/d/Y"',

        ];

    }





}
