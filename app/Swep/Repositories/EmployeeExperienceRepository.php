<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmployeeExperienceInterface;

use App\Models\EmployeeExperience;


class EmployeeExperienceRepository extends BaseRepository implements EmployeeExperienceInterface {
	



    protected $employee_exp;




	public function __construct(EmployeeExperience $employee_exp){

        $this->employee_exp = $employee_exp;
        parent::__construct();

    }






    public function store($data, $employee){

        $employee_exp = new EmployeeExperience;
        $employee_exp->employee_no = $employee->employee_no;
        $employee_exp->date_from = $this->dataTypeHelper->date_in($data['date_from']);
        $employee_exp->date_to = $this->dataTypeHelper->date_in($data['date_to']);
        $employee_exp->position = $data['position'];
        $employee_exp->company = $data['company'];
        $employee_exp->salary = $this->dataTypeHelper->string_to_num($data['salary']);
        $employee_exp->salary_grade = $data['salary_grade'];
        $employee_exp->appointment_status = $data['appointment_status'];
        $employee_exp->is_gov_service =  $this->dataTypeHelper->string_to_boolean($data['is_gov_service']);
        $employee_exp->save();

    }








}