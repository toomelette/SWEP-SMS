<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeReference extends Model{




	protected $table = 'employee_references';




    protected $attributes = [
        
        'employee_no' => '',
        'fullname' => '',
        'address' => '',
        'tel_no' => '',

    ];





    // RELATIONSHIPS
    public function employee() {
    	return $this->belongsTo('App\Models\Employee','employee_no','employee_no');
    }
    


    // SCOPES
    public function scopePopulate($query){

        return $query->orderBy('fullname', 'desc')->get();

    }



   
}
