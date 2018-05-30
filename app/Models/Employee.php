<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Employee extends Model{



	use Sortable;

    protected $table = 'employees';

    protected $dates = ['dob', 'apptdate', 'adjdate', 'created_at', 'updated_at'];

    public $timestamps = false;





    protected $attributes = [
        
        'slug' => '',
        'employee_id' => '',
        'user_id' => '',
        'project_id' => '',
        'department_id' => '',
        'department_unit_id' => '',
        'empno' => '',
        'stationid' => '',
        'empname' => '',
        'lastname' => '',
        'firstname' => '',
        'middlename' => '',
        'address' => '',
        'dob' => null,
        'pob' => '',
        'gender' => '',
        'bloodtype' => '',
        'civilstat' => '',
        'undergrad' => '',
        'graduate1' => '',
        'graduate2' => '',
        'postgrad1' => '',
        'eligibility' => '',
        'eligibilitylevel' => '',
        'dept' => '',
        'division' => '',
        'position' => '',
        'salgrade' => null,
        'stepinc' => null,
        'apptstat' => '',
        'itemno' => null,
        'monthlybasic' => 0.00,
        'aca' => 0.00,
        'pera' => 0.00,
        'foodsubsi' => 0.00,
        'allow1' => 0.00,
        'allow2' => 0.00,
        'govserv' => null,
        'firstday' => null,
        'apptdate' => null,
        'adjdate' => null,
        'phic' => '',
        'tin' => '',
        'hdmf' => '',
        'gsis' => '',
        'active' => '',
        'groups' => '',
        'hdmfpremiums' => 0.00,

        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];





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





    // GETTERS
    public function getEmployeeIdIncAttribute(){

        $id = 'E1001';

        $employee = $this->select('employee_id')->orderBy('employee_id', 'desc')->first();

        if($employee != null){

            if($employee->employee_id != null){

                $num = str_replace('E', '', $employee->employee_id) + 1;
            
                $id = 'E' . $num;
                
            }
        
        }
        
        return $id;
        
    }





}
