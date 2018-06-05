<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeRecognition extends Model{



	protected $table = 'employee_recognitions';




    protected $attributes = [
        
        'employee_no' => '',
        'title' => '',

    ];





    // RELATIONSHIPS
    public function employee() {
    	return $this->belongsTo('App\Models\Employee','employee_no','employee_no');
    }
    
    


    // SCOPES
    public function scopePopulate($query){

        return $query->orderBy('title', 'desc')->get();

    }



    
}
