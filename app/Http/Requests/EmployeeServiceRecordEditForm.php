<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeServiceRecordEditForm extends FormRequest{


    
    public function authorize(){

        return true;
    
    }

    



    public function rules(){

        return [

            'e_slug'=>'required|string|max:45',
            'e_sequence_no'=>'required|int|max:1000',
            'e_date_from'=>'required|string|max:45',
            'e_date_to'=>'required|string|max:45',
            'e_position'=>'required|string|max:45',
            'e_appointment_status'=>'required|string|max:45',
            'e_salary'=>'required|string|max:12',
            'e_mode_of_payment'=>'required|string|max:45',
            'e_station'=>'required|string|max:45',
            'e_gov_serve'=>'nullable|string|max:45',
            'e_psc_serve'=>'nullable|string|max:45',
            'e_lwp'=>'nullable|string|max:20',
            'e_spdate'=>'nullable|string|max:20',
            'e_status'=>'nullable|string|max:90',
            'e_remarks'=>'nullable|string|max:200',

        ];

    }




}
