<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeExperience extends Model{





	protected $table = 'employee_experiences';

    protected $dates = ['date_from', 'date_to'];

    public $timestamps = false;
    




    protected $attributes = [
        
        'employee_no' => '',
        'date_from' => null,
        'date_to' => null,
        'position' => '',
        'company' => '',
        'salary' => 0.00,
        'salary_grade' => 0,
        'appointment_status' => '',
        'is_gov_service' => false,

    ];






    /** RELATIONSHIPS **/
    public function employee() {
    	return $this->belongsTo('App\Models\Employee','employee_no','employee_no');
    }
    




    /** Scopes **/
    public function scopePopulate($query){

        return $query->orderBy('date_from', 'desc')->get();

    }





    
}
