<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeServiceRecord extends Model{


	protected $table = 'employee_service_records';

    protected $dates = ['created_at', 'updated_at'];

    public $timestamps = false;
    


    protected $attributes = [
        
        'slug' => '',
        'employee_no' => '',
        'sequence_no' => null,
        'date_from' => '',
        'date_to' => '',
        'position' => '',
        'appointment_status' => '',
        'salary' => 0.00,
        'mode_of_payment' => '',
        'station' => '',
        'gov_serve' => '',
        'psc_serve' => '',
        'lwp' => '',
        'spdate' => '',
        'status' => '',
        'remarks' => '',
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];




    // RELATIONSHIPS
    public function employee() {
    	return $this->belongsTo('App\Models\Employee','employee_no','employee_no');
    }
    


    // SCOPES
    public function scopePopulate($query){

        return $query->orderBy('sequence_no', 'asc')->get();

    }



    public function scopePopulateByEmpNo($query, $employee_no){

        return $query->where('employee_no', $employee_no)->orderBy('sequence_no', 'asc')->get();

    }

    

    public function scopeFindSlug($query, $slug){

        return $query->where('slug', $slug)->firstOrFail();

    }
    
    

}
