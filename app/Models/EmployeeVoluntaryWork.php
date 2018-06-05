<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeVoluntaryWork extends Model{




	protected $table = 'employee_voluntary_works';

    protected $dates = ['date_from', 'date_to'];




    protected $attributes = [
        
        'employee_no' => '',
        'name' => '',
        'address' => '',
        'date_from' => null,
        'date_to' => null,
        'hours' => null,
        'position' => '',

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
