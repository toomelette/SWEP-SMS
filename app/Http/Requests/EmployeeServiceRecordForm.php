<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeServiceRecordForm extends FormRequest{


    public function authorize(){

        return true;
    
    }




    public function rules(){

        return [
            
            'sequence_no'=>'required|int|max:100',
            'date_from'=>'required|string|max:45',
            'date_to'=>'required|string|max:45',
            'position'=>'required|string|max:45',
            'appointment_status'=>'required|string|max:45',
            'salary'=>'required|string|max:12',
            'mode_of_payment'=>'required|string|max:45',
            'station'=>'required|string|max:45',
            'gov_serve'=>'nullable|string|max:45',
            'psc_serve'=>'nullable|string|max:45',
            'lwp'=>'nullable|string|max:20',
            'spdate'=>'nullable|string|max:20',
            'status'=>'nullable|string|max:90',
            'remarks'=>'nullable|string|max:200',

        ];

    }



}
