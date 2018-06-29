<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeServiceRecord extends Model{


	protected $table = 'employee_service_records';

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

    ];




    // RELATIONSHIPS
    public function employee() {
    	return $this->belongsTo('App\Models\Employee','employee_no','employee_no');
    }
    


    // SCOPES
    public function scopePopulate($query){

        return $query->orderBy('sequence_no	', 'asc')->get();

    }

    

    public function scopeFindSlug($query, $slug){

        return $query->where('slug', $slug)->firstOrFail();

    }
    
    

}
