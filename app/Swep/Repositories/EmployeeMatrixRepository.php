<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmployeeMatrixInterface;


use App\Models\EmployeeMatrix;


class EmployeeMatrixRepository extends BaseRepository implements EmployeeMatrixInterface {
	


    protected $employee_matrix;



	public function __construct(EmployeeMatrix $employee_matrix){

        $this->employee_matrix = $employee_matrix;
        parent::__construct();

    }





}