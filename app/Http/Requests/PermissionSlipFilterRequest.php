<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionSlipFilterRequest extends FormRequest{
   


    public function authorize(){

        return true;
    }

    


    public function rules(){

        return [

            'q' => 'nullable|string|max:90',
            'emp' => 'nullable|string|max:20',
            'd' => 'nullable|date_format:"m/d/Y"',

        ];

    }



}
