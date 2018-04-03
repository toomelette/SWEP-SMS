<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model{


    protected $table = 'departments';

    protected $dates = ['created_at', 'updated_at'];

	public $timestamps = false;



	public function accounts() {

        return $this->hasMany('App\Models\Accounts','department_id','department_id');

    }



    public function departmentUnits() {

        return $this->hasMany('App\Models\DepartmentUnits','department_id','department_id');

    }



}
