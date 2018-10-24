<?php

namespace App\Http\Requests\PermissionSlip;

use Illuminate\Foundation\Http\FormRequest;

class PermissionSlipReportRequest extends FormRequest{



    
    public function authorize(){

        return true;
    
    }





    public function rules(){

        return [

            'd' => 'required|string|max:5',
            'df' => 'required|date_format:"m/d/Y"',
            'dt' => 'required|date_format:"m/d/Y"',

        ];
    
    }





}
