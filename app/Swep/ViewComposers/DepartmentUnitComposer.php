<?php

namespace App\Swep\ViewComposers;


use View;
use App\Models\DepartmentUnit;
use Illuminate\Cache\Repository as Cache;


class DepartmentUnitComposer{
   

	protected $department_unit;
	protected $cache;


	public function __construct(DepartmentUnit $department_unit, Cache $cache){
		$this->department_unit = $department_unit;
		$this->cache = $cache;
	}



    public function compose($view){

        $department_units = $this->cache->remember('department_units:global:all', 240, function(){
        	return $this->department_unit->select('name', 'department_unit_id', 'description')->get();
        });
        
    	$view->with('global_department_units_all', $department_units);
    	
    }




}