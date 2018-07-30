<?php

namespace App\Swep\ViewComposers;


use View;
use App\Swep\Interfaces\DepartmentUnitInterface;


class DepartmentUnitComposer{
   


	protected $department_unit_repo;



	public function __construct(DepartmentUnitInterface $department_unit_repo){

		$this->department_unit_repo = $department_unit_repo;

	}



    public function compose($view){

        $department_units = $this->department_unit_repo->globalFetchAll();
        
    	$view->with('global_department_units_all', $department_units);
    	
    }




}