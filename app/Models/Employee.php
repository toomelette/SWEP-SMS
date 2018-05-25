<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Employee extends Model{



	use Sortable;

    protected $table = 'employees';

    protected $dates = ['dob', 'apptdate', 'adjdate', 'created_at', 'updated_at'];

    public $timestamps = false;




    //RELATIONSHIPS
    public function department(){
        return $this->hasOne('App\Models\Department', 'department_id', 'department_id');
    }


    public function departmentUnit(){
        return $this->hasOne('App\Models\Project', 'department_unit_id', 'department_unit_id');
    }


    public function project(){
        return $this->hasOne('App\Models\Project', 'project_id', 'project_id');
    }


    public function employeeTraining(){
        return $this->hasMany('App\Models\EmployeeTraining', 'empno', 'empno');
    }


    public function user() {
      	return $this->belongsTo('App\Models\User','user_id','user_id');
    }






    // SCOPES
    public function scopePopulate($query){

        return $query->sortable()->orderBy('lastname', 'asc')->paginate(10);

    }



    public function scopeSearch($query, $key){

        return $query->where(function ($query) use ($key) {
                $query->where('empno', 'LIKE', '%'. $key .'%')
                      ->orwhere('lastname', 'LIKE', '%'. $key .'%')
                      ->orwhere('firstname', 'LIKE', '%'. $key .'%')
                      ->orwhere('empname', 'LIKE', '%'. $key .'%');
        });

    }



    public function scopeFindSlug($query, $slug){

        return $query->where('slug', $slug)->with('employeeTraining')->firstOrFail();

    }



}
