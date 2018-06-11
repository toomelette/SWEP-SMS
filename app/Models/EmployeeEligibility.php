<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeEligibility extends Model{



	protected $table = 'employee_eligibilities';

    protected $dates = ['exam_date'];

    public $timestamps = false;
    


    protected $attributes = [
        
        'employee_no' => '',
        'eligibility' => '',
        'level' => '',
        'rating' => null,
        'exam_place' => '',
        'exam_date' => null,
        'license_no' => '',
        'license_validity' => null,

    ];





    // RELATIONSHIPS
    public function employee() {
    	return $this->belongsTo('App\Models\Employee','employee_no','employee_no');
    }
    


    // SCOPES
    public function scopePopulate($query){

        return $query->orderBy('exam_date', 'desc')->get();

    }


    
}
