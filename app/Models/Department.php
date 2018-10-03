<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Department extends Model{



    use Sortable;

    protected $table = 'departments';

    protected $dates = ['created_at', 'updated_at'];

    public $sortable = ['name'];

	public $timestamps = false;





    protected $attributes = [

        'slug' => '',
        'department_id' => '',
        'name' => '',
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];





    /** RELATIONSHIPS **/
    public function employee() {
        return $this->hasMany('App\Models\Employee','department_id','department_id');
    }


	public function projectCode() {
        return $this->hasMany('App\Models\ProjectCode','department_id','department_id');
    }


    public function departmentUnit() {
        return $this->hasMany('App\Models\DepartmentUnit','department_id','department_id');
    }







}
