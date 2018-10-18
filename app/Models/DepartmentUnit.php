<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class DepartmentUnit extends Model{




    use Sortable;

    protected $table = 'department_units';

    protected $dates = ['created_at', 'updated_at'];

    public $sortable = ['department_name','name', 'description'];

	public $timestamps = false;






    protected $attributes = [

        'slug' => '',
        'department_unit_id' => '',
        'department_id' => '',
        'department_name' => '',
        'name' => '',
        'description' => '',
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];






    /** RELATIONSHIPS **/
	public function department() {
      return $this->belongsTo('App\Models\Department','department_id','department_id');
    }


    public function employee(){
        return $this->hasMany('App\Models\Employee', 'department_unit_id', 'department_unit_id');
    }
    






}
