<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmployeeReferenceInterface;

use App\Models\EmployeeReference;


class EmployeeReferenceRepository extends BaseRepository implements EmployeeReferenceInterface {
	



    protected $employee_ref;




	public function __construct(EmployeeReference $employee_ref){

        $this->employee_ref = $employee_ref;
        parent::__construct();

    }






    public function store($data, $employee){

        $employee_reference = new EmployeeReference;
        $employee_reference->employee_no = $employee->employee_no;
        $employee_reference->fullname = $data['fullname'];
        $employee_reference->address = $data['address'];
        $employee_reference->tel_no = $data['tel_no'];
        $employee_reference->save();

    }








}