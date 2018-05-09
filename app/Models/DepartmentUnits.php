<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class DepartmentUnits extends Model{

    use Sortable;

    protected $table = 'department_units';

    protected $dates = ['created_at', 'updated_at'];

    public $sortable = ['department_name','name', 'description'];

	public $timestamps = false;



	protected $fillable = [

        'slug',
        'department_id',
        'department_name',
        'name',
        'description',
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
        'department_id' => '',
        'department_name' => '',
        'name' => '',
        'description' => '',
        'created_at' => null, 
        'updated_at' => null,
        'machine_created' => '',
        'machine_updated' => '', 
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



	public function departments() {
      
      return $this->belongsTo('App\Models\Departments','department_id','department_id');

    }
    


    // SCOPE

    public function scopePopulate($query){

        return $query->sortable()->orderBy('updated_at', 'desc')->paginate(10);

    }



    public function scopeSearch($query, $key){

        return $query->where(function ($query) use ($key) {
                $query->where('department_name', 'LIKE', '%'. $key .'%')
                      ->orwhere('name', 'LIKE', '%'. $key .'%')
                      ->orwhere('description', 'LIKE', '%'. $key .'%');
        });

    }



    public function scopeFindSlug($query, $slug){

        return $query->where('slug', $slug)->firstOrFail();

    }



    // GETTERS

    public function getLastDepartmentUnitAttribute(){

        $department_unit = $this->select('department_unit_id')->orderBy('department_unit_id', 'desc')->first();

        if($department_unit != null){

          return str_replace('DU', '', $department_unit->department_unit_id);

        }

        return null;
        
    }




    public function getDepartmentUnitIdIncrementAttribute(){

        $id = '1001';

        if($id != null){

            $num =  $this->lastDepartmentUnit + 1;
            
            $id = 'DU' . $num;
        
        }

        return $id;

    }




}
