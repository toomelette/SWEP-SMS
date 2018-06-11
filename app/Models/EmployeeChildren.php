<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeChildren extends Model{



	protected $table = 'employee_children';

    protected $dates = ['date_of_birth'];

    public $timestamps = false;
    


    protected $attributes = [
        
        'employee_no' => '',
        'fullname' => '',
        'date_of_birth' => null,

    ];





    // RELATIONSHIPS
    public function employee() {
    	return $this->belongsTo('App\Models\Employee','employee_no','employee_no');
    }
    


    // SCOPES
    public function scopePopulate($query){

        return $query->orderBy('date_of_birth', 'desc')->get();

    }
    

    
}
