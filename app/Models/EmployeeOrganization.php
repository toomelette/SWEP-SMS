<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeOrganization extends Model{





	protected $table = 'employee_organizations';

    public $timestamps = false;

    



    protected $attributes = [
        
        'employee_no' => '',
        'name' => '',

    ];






    /** RELATIONSHIPS **/
    public function employee() {
    	return $this->belongsTo('App\Models\Employee','employee_no','employee_no');
    }
    




    /** Scopes **/
    public function scopePopulate($query){

        return $query->orderBy('name', 'desc')->get();

    }






    
}
