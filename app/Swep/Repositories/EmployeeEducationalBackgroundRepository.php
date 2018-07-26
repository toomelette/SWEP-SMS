<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmployeeEducationalBackgroundInterface;

use App\Models\EmployeeEducationalBackground;


class EmployeeEducationalBackgroundRepository extends BaseRepository implements EmployeeEducationalBackgroundInterface {
	



    protected $employee_eb;




	public function __construct(EmployeeEducationalBackground $employee_eb){

        $this->employee_eb = $employee_eb;
        parent::__construct();

    }






    public function store($data, $employee){
        
        $employee_eb = new EmployeeEducationalBackground;
        $employee_eb->employee_no = $employee->employee_no;
        $employee_eb->level = $data['level'];
        $employee_eb->school_name = $data['school_name'];
        $employee_eb->course = $data['course'];
        $employee_eb->date_from = $data['date_from'];
        $employee_eb->date_to = $data['date_to'];
        $employee_eb->units = $data['units'];
        $employee_eb->graduate_year = $data['graduate_year'];
        $employee_eb->scholarship = $data['scholarship'];
        $employee_eb->save();

    }  












}