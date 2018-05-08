<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Departments extends Model{

    use Sortable;

    protected $table = 'departments';

    protected $dates = ['created_at', 'updated_at'];

    public $sortable = ['name'];

	public $timestamps = false;



	protected $fillable = [

        'slug',
        'name',
        'created_at', 
        'updated_at',
        'machine_created',
        'machine_updated', 
        'ip_created',
        'ip_updated',
        'user_created',
        'user_updated',

    ];




    protected $attributes = [

        'slug' => '',
        'name' => '',
        'created_at' => null, 
        'updated_at' => null,
        'machine_created' => '',
        'machine_updated' => '', 
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];




	public function accounts() {

        return $this->hasMany('App\Models\Accounts','department_id','department_id');

    }



    public function departmentUnits() {

        return $this->hasMany('App\Models\DepartmentUnits','department_id','department_id');

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

    public function getLastDepartmentAttribute(){

        $department = $this->select('department_id')->orderBy('department_id', 'desc')->first();

        if($department != null){

          return str_replace('D', '', $department->department_id);

        }

        return null;
        
    }




    public function getDepartmentIdIncrementAttribute(){

        $id = '1001';

        if($id != null){

            $num =  $this->lastDepartment + 1;
            
            $id = 'D' . $num;
        
        }

        return $id;

    }


}
