<?php

namespace App\Swep\ViewComposers;


use View;
use App\Swep\Interfaces\DepartmentInterface;


class DepartmentComposer{
   


	protected $department_repo;



	public function __construct(DepartmentInterface $department_repo){

		$this->department_repo = $department_repo;
		
	}





    public function compose($view){

        $departments = $this->department_repo->getAll();
        
    	$view->with('global_departments_all', $departments);

    }





}