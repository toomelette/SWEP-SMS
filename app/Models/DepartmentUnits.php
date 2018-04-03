<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepartmentUnits extends Model{


    protected $table = 'department_units';

    protected $dates = ['created_at', 'updated_at'];

	public $timestamps = false;



	public function departments() {
      
      return $this->belongsTo('App\Models\Departments','department_id','department_id');

    }
    


}
