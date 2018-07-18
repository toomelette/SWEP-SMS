<?php

namespace App\Swep\ViewComposers;


use View;
use App\Models\Department;
use Illuminate\Cache\Repository as Cache;


class DepartmentComposer{
   

	protected $department;
	protected $cache;


	public function __construct(Department $department, Cache $cache){

		$this->department = $department;
		$this->cache = $cache;
		
	}



    public function compose($view){

        $departments = $this->cache->remember('departments:global:all', 240, function(){
        	return $this->department->select('name', 'department_id')->get();
        });
        
    	$view->with('global_departments_all', $departments);

    }




}