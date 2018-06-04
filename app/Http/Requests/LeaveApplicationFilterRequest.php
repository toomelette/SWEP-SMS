<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveApplicationFilterRequest extends FormRequest{



    public function authorize(){

        return true;
    }

   


    public function rules(){

        return [

            'q' => 'nullable|string|max:90',
            't' => 'nullable|string|min:5|max:5',
            'df' => 'nullable|date_format:"m/d/Y"',
            'dt' => 'nullable|date_format:"m/d/Y"',

        ];

    }





}
