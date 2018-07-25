<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmployeeInterface;


use App\Models\Employee;


class EmployeeRepository extends BaseRepository implements EmployeeInterface {
	



    protected $employee;




	public function __construct(Employee $employee){

        $this->employee = $employee;

        parent::__construct();

    }






    public function findBySlug($slug){

        $employee = $this->cache->remember('employees:bySlug:' . $slug, 240, function() use ($slug){
            return $this->employee->where('slug', $slug)->first();
        });
        
        return $employee;

    }






    public function findByUserId($user_id){

        $employee = $this->cache->remember('employees:byUserId:' . $user_id, 240, function() use ($user_id){
            return $this->employee->where('user_id', $user_id)->first();
        });
        
        return $employee;

    }









}