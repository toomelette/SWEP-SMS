<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeOrganization extends Model{



	protected $table = 'employee_organizations';



    protected $attributes = [
        
        'employee_no' => '',
        'name' => '',

    ];





    // RELATIONSHIPS
    public function employee() {
    	return $this->belongsTo('App\Models\Employee','employee_no','employee_no');
    }
    


    // SCOPES
    public function scopePopulate($query){

        return $query->orderBy('name', 'desc')->get();

    }


    
}
