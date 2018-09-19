<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmployeeChildrenInterface;

use App\Models\EmployeeChildren;


class EmployeeChildrenRepository extends BaseRepository implements EmployeeChildrenInterface {
	



    protected $employee_children;




	public function __construct(EmployeeChildren $employee_children){

        $this->employee_children = $employee_children;
        parent::__construct();

    }






    public function store($data, $employee){

        $employee_children = new EmployeeChildren;
        $employee_children->employee_no = $employee->employee_no;
        $employee_children->fullname = $data['fullname'];
        $employee_children->date_of_birth = $this->__dataType->date_parse($data['date_of_birth'], 'Y-m-d');
        $employee_children->save();
        
    }








}