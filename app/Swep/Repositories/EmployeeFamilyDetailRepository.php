<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmployeeFamilyDetailInterface;

use App\Models\EmployeeFamilyDetail;


class EmployeeFamilyDetailRepository extends BaseRepository implements EmployeeFamilyDetailInterface {
	



    protected $employee_family_detail;




	public function __construct(EmployeeFamilyDetail $employee_family_detail){

        $this->employee_family_detail = $employee_family_detail;
        parent::__construct();

    }






    public function store($request, $employee){

        $employee_family_details = new EmployeeFamilyDetail;
        $employee_family_details->employee_no = $employee->employee_no;
        $employee_family_details->spouse_lastname = $request->spouse_lastname;
        $employee_family_details->spouse_firstname = $request->spouse_firstname;
        $employee_family_details->spouse_middlename = $request->spouse_middlename;
        $employee_family_details->spouse_name_ext = $request->spouse_name_ext;
        $employee_family_details->spouse_occupation = $request->spouse_occupation;
        $employee_family_details->spouse_employer = $request->spouse_employer;
        $employee_family_details->spouse_business_address = $request->spouse_business_address;
        $employee_family_details->spouse_tel_no = $request->spouse_tel_no;
        $employee_family_details->father_lastname = $request->father_lastname;
        $employee_family_details->father_firstname = $request->father_firstname;
        $employee_family_details->father_middlename = $request->father_middlename;
        $employee_family_details->father_name_ext = $request->father_name_ext;
        $employee_family_details->mother_lastname = $request->mother_lastname;
        $employee_family_details->mother_firstname = $request->mother_firstname;
        $employee_family_details->mother_middlename = $request->mother_middlename;
        $employee_family_details->mother_name_ext = $request->mother_name_ext;
        $employee_family_details->save();
        
    }








}