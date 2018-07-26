<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmployeeOrganizationInterface;

use App\Models\EmployeeOrganization;


class EmployeeOrganizationRepository extends BaseRepository implements EmployeeOrganizationInterface {
	



    protected $employee_org;




	public function __construct(EmployeeOrganization $employee_org){

        $this->employee_org = $employee_org;
        parent::__construct();

    }






    public function store($data, $employee){

        $employee_org = new EmployeeOrganization;
        $employee_org->employee_no = $employee->employee_no;
        $employee_org->name = $data['name'];
        $employee_org->save();

    }








}