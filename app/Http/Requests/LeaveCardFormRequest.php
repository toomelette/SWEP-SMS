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
            'month' => 'sometimes|required|string|max:20',
            'year' => 'sometimes|required|integer|max:3000|min:2000',
            'date' => 'sometimes|required|date_format:"m/d/Y"',
            'date_from' => 'sometimes|required|date_format:"m/d/Y"',
            'date_to' => 'sometimes|required|date_format:"m/d/Y"',
            'time_from' => 'sometimes|required|date_format:"h:i A"',
            'time_to' => 'sometimes|required|date_format:"h:i A"',
            'days' => 'sometimes|required|integer|max:240',
            'hrs' => 'sometimes|required|integer|max:90',
            'mins' => 'sometimes|required|integer|max:60',

        ];
    
    }





}
