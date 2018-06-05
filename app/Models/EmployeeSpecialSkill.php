<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeSpecialSkill extends Model{



	protected $table = 'employee_special_skills';



    protected $attributes = [
        
        'employee_no' => '',
        'description' => '',

    ];





    // RELATIONSHIPS
    public function employee() {
    	return $this->belongsTo('App\Models\Employee','employee_no','employee_no');
    }
    


    // SCOPES
    public function scopePopulate($query){

        return $query->orderBy('description', 'desc')->get();

    }



    
}
