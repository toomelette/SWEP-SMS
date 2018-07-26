<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmployeeRecognitionInterface;

use App\Models\EmployeeRecognition;


class EmployeeRecognitionRepository extends BaseRepository implements EmployeeRecognitionInterface {
	



    protected $employee_recog;




	public function __construct(EmployeeRecognition $employee_recog){

        $this->employee_recog = $employee_recog;
        parent::__construct();

    }






    public function store($data, $employee){

        $employee_recog = new EmployeeRecognition;
        $employee_recog->employee_no = $employee->employee_no;
        $employee_recog->title = $data['title'];
        $employee_recog->save();

    }








}