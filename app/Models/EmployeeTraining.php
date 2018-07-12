<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class EmployeeTraining extends Model{




    protected $table = 'employee_trainings';

    protected $dates = ['date_from', 'date_to'];

    public $timestamps = false;
    


    protected $attributes = [
        
        'employee_no' => '',
        'slug' => '',
        'title' => '',
        'type' => '',
        'date_from' => null,
        'date_to' => null,
        'hours' => null,
        'conducted_by' => '',
        'venue' => '',
        'remarks' => '',

    ];






    // RELATIONSHIPS
    public function employee() {
    	return $this->belongsTo('App\Models\Employee','employee_no','employee_no');
    }
    




    // SCOPES
    public function scopePopulate($query){

        return $query->orderBy('date_from', 'asc')->get();

    }
    




}
