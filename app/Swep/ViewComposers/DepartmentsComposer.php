<?php

namespace App\Swep\ViewComposers;


use View;
use App\Models\Departments;
use Illuminate\Cache\Repository as Cache;


class DepartmentsComposer{
   

	protected $departments;
	protected $cache;


	public function __construct(Departments $departments, Cache $cache){

		$this->departments = $departments;
		$this->cache = $cache;
		
	}



    public function compose($view){

        $departments = $this->cache->remember('departments:all', 240, function(){
        	return $this->departments->select('name', 'department_id')->get();
        });
        
    	$view->with('global_departments_all', $departments);

    }




}