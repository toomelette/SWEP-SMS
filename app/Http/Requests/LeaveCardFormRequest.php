<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveCardFormRequest extends FormRequest{
    



    public function authorize(){

        return true;
    
    }






    public function rules(){

        return [
            
            'doc_type' => 'sometimes|required|string|max:20',
            'employee_no' => 'sometimes|required|string|max:20',
            'leave_type' => 'sometimes|required|string|max:20',
            'month' => 'required|string|max:20',
            'year' => 'required|int|max:3000|min:2000',
            'date_from' => 'sometimes|required|date_format:"m/d/Y"',
            'date_to' => 'sometimes|required|date_format:"m/d/Y"',
            'time_from' => 'sometimes|required|date_format:"h:i A"',
            'time_to' => 'sometimes|required|date_format:"h:i A"',
            'days' => 'sometimes|required|int"',
            'hrs' => 'sometimes|required|int"',
            'mins' => 'sometimes|required|int|max:60"',

        ];
    
    }





}
