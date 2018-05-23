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




	public function account() {

        return $this->hasMany('App\Models\Account','department_id','department_id');

    }



    public function departmentUnit() {

        return $this->hasMany('App\Models\DepartmentUnit','department_id','department_id');

    }




    // SCOPES

    public function scopePopulate($query){

        return $query->sortable()->orderBy('updated_at', 'desc')->paginate(10);

    }



    public function scopeSearch($query, $key){

        return $query->where(function ($query) use ($key) {
                $query->where('name', 'LIKE', '%'. $key .'%');
        });

    }



    public function scopeFindSlug($query, $slug){

        return $query->where('slug', $slug)->firstOrFail();

    }




    // GETTERS

    public function getDepartmentIdIncAttribute(){

        $id = 'D1001';

        $department = $this->select('department_id')->orderBy('department_id', 'desc')->first();

        if($department != null){

            $num = str_replace('D', '', $department->department_id) + 1;
            
            $id = 'D' . $num;
        
        }
        
        return $id;
        
    }





}
