<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class ProjectCode extends Model{

	use Sortable;

    protected $table = 'project_codes';

    protected $dates = ['date_started', 'projected_date_end', 'created_at', 'updated_at'];

    public $sortable = ['project_code', 'department_name', 'description', 'project_in_charge'];

	public $timestamps = false;


    protected $attributes = [
        
        'slug' => '',
        'project_code_id' => '',
        'department_id' => '',
        'department_name' => '',
        'project_code' => '',
        'description' => '',
        'mooe' => 0.00,
        'co' => 0.00,
        'date_started' => null,
        'projected_date_end' => null,
        'project_in_charge' => '',
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];



	public function department() {
      
      return $this->belongsTo('App\Models\Department','department_id','department_id');

    }




    // SCOPES

    public function scopePopulate($query){

        return $query->select('project_code', 'department_name', 'description', 'project_in_charge', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }



    public function scopeSearch($query, $key){

        return $query->where(function ($query) use ($key) {
                $query->where('department_name', 'LIKE', '%'. $key .'%')
                	  ->orwhere('project_code', 'LIKE', '%'. $key .'%')
                	  ->orwhere('description', 'LIKE', '%'. $key .'%')
                	  ->orwhere('project_in_charge', 'LIKE', '%'. $key .'%');
        });

    }



    public function scopeFindSlug($query, $slug){

        return $query->where('slug', $slug)->firstOrFail();

    }





    // GETTERS
    public function getProjectCodeIdIncAttribute(){

        $id = 'A1001';

        $project_code = $this->select('project_code_id')->orderBy('project_code_id', 'desc')->first();

        if($project_code != null){

            if($project_code->project_code_id != null){

                $num = str_replace('A', '', $project_code->project_code_id) + 1;
                
                $id = 'A' . $num;

            }
            
        }
        
        return $id;
        
    }





}
