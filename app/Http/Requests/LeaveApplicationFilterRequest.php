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




    public function messages(){

        return [
            
            'q.string'  => 'Invalid input, must be a string!',
            'q.max'  => 'The User Status field may not be greater than 90 characters.',

            't.string'  => 'Invalid input, must be a string!',
            't.max'  => 'The User Status field may not be greater than 5 characters.',
            't.max'  => 'The User Status field may not be greater than 5 characters.',

            'df.date_format'  => 'Invalid Format! The Date does not match the format mm/dd/yy',
            
            'dt.date_format'  => 'Invalid Format! The Date does not match the format mm/dd/yy',

        ];

    }



}
