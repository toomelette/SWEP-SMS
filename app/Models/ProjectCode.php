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






}
