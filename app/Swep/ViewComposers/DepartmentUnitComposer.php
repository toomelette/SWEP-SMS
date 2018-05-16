<?php

namespace App\Swep\ViewComposers;


use View;
use App\Models\DepartmentUnit;
use Illuminate\Cache\Repository as Cache;


class DepartmentUnitComposer{
   

	protected $department_units;
	protected $cache;


	public function __construct(DepartmentUnit $department_units, Cache $cache){
		$this->department_units = $department_units;
		$this->cache = $cache;
	}



    public function compose($view){

        $department_units = $this->cache->remember('department_units:global:all', 240, function(){
        	return $this->department_units->select('name')->get();
        });
        
    	$view->with('global_department_units_all', $department_units);
    	
    }




}