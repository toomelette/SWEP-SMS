<?php

namespace App\Swep\ViewComposers;


use View;
use App\Swep\Interfaces\EmployeeInterface;


class EmployeeComposer{
   



	protected $employee_repo;




	public function __construct(EmployeeInterface $employee_repo){

		$this->employee_repo = $employee_repo;
		
	}






    public function compose($view){

        $employees = $this->employee_repo->getAll();
        
    	$view->with('global_employees_all', $employees);

    }






}