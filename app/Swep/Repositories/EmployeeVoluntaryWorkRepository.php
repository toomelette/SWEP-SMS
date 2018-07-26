<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmployeeVoluntaryWorkInterface;

use App\Models\EmployeeVoluntaryWork;


class EmployeeVoluntaryWorkRepository extends BaseRepository implements EmployeeVoluntaryWorkInterface {
	



    protected $employee_vw;




	public function __construct(EmployeeVoluntaryWork $employee_vw){

        $this->employee_vw = $employee_vw;
        parent::__construct();

    }





    public function store($data, $employee){

        $employee_vw = new EmployeeVoluntaryWork;
        $employee_vw->employee_no = $employee->employee_no;
        $employee_vw->name = $data['name'];
        $employee_vw->address = $data['address'];
        $employee_vw->date_from = $this->dataTypeHelper->date_in($data['date_from']);
        $employee_vw->date_to = $this->dataTypeHelper->date_in($data['date_to']);
        $employee_vw->hours = $data['hours'];
        $employee_vw->position = $data['position'];
        $employee_vw->save();

    }






}