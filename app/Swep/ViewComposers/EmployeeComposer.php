<?php

namespace App\Swep\ViewComposers;


use View;
use App\Models\Employee;
use Illuminate\Cache\Repository as Cache;


class EmployeeComposer{
   

	protected $employee;
	protected $cache;


	public function __construct(Employee $employee, Cache $cache){

		$this->employee = $employee;
		$this->cache = $cache;
		
	}



    public function compose($view){

        $employees = $this->cache->remember('employees:global:all', 240, function(){
        	return $this->employee->select('slug', 'fullname')->get();
        });
        
    	$view->with('global_employees_all', $employees);

    }




}