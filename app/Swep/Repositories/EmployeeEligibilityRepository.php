<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmployeeEligibilityInterface;

use App\Models\EmployeeEligibility;


class EmployeeEligibilityRepository extends BaseRepository implements EmployeeEligibilityInterface {
	



    protected $employee_elig;




	public function __construct(EmployeeEligibility $employee_elig){

        $this->employee_elig = $employee_elig;
        parent::__construct();

    }






    public function store($data, $employee){

        $employee_elig = new EmployeeEligibility;
        $employee_elig->employee_no = $employee->employee_no;
        $employee_elig->eligibility = $data['eligibility'];
        $employee_elig->level = $data['level'];
        $employee_elig->rating = $data['rating'];
        $employee_elig->exam_place = $data['exam_place'];
        $employee_elig->exam_date = $this->dataTypeHelper->date_parse($data['exam_date'], 'Y-m-d');
        $employee_elig->license_no = $data['license_no'];
        $employee_elig->license_validity = $this->dataTypeHelper->date_parse($data['license_validity'], 'Y-m-d');
        $employee_elig->save();

    }








}