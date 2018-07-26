<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmployeeAddressInterface;

use App\Models\EmployeeAddress;


class EmployeeAddressRepository extends BaseRepository implements EmployeeAddressInterface {
	



    protected $employee_address;




	public function __construct(EmployeeAddress $employee_address){

        $this->employee_address = $employee_address;
        parent::__construct();

    }






    public function store($request, $employee){

        $employee_address = new EmployeeAddress;
        $employee_address->employee_no = $employee->employee_no;
        $employee_address->res_address_block = $request->res_address_block;
        $employee_address->res_address_street = $request->res_address_street;
        $employee_address->res_address_village = $request->res_address_village;
        $employee_address->res_address_barangay = $request->res_address_barangay;
        $employee_address->res_address_city = $request->res_address_city;
        $employee_address->res_address_province = $request->res_address_province;
        $employee_address->res_address_zipcode = $request->res_address_zipcode;
        $employee_address->perm_address_block = $request->perm_address_block;
        $employee_address->perm_address_street = $request->perm_address_street;
        $employee_address->perm_address_village = $request->perm_address_village;
        $employee_address->perm_address_barangay = $request->perm_address_barangay;
        $employee_address->perm_address_city = $request->perm_address_city;
        $employee_address->perm_address_province = $request->perm_address_province;
        $employee_address->perm_address_zipcode = $request->perm_address_zipcode;
        $employee_address->save();
        
    }








}