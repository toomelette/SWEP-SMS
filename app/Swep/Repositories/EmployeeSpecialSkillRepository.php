<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmployeeSpecialSkillInterface;

use App\Models\EmployeeSpecialSkill;


class EmployeeSpecialSkillRepository extends BaseRepository implements EmployeeSpecialSkillInterface {
	



    protected $employee_ss;




	public function __construct(EmployeeSpecialSkill $employee_ss){

        $this->employee_ss = $employee_ss;
        parent::__construct();

    }






    public function store($data, $employee){

        $employee_ss = new EmployeeSpecialSkill;
        $employee_ss->employee_no = $employee->employee_no;
        $employee_ss->description = $data['description'];
        $employee_ss->save();

    }








}