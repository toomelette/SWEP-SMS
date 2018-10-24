<?php

namespace App\Http\Controllers;


use App\Swep\Services\EmployeeService;
use App\Swep\Services\EmployeeTrainingService;
use App\Swep\Services\EmployeeServiceRecordService;

use App\Http\Requests\Employee\EmployeeFormRequest;
use App\Http\Requests\Employee\EmployeeFilterRequest;
use App\Http\Requests\Employee\EmployeeReportRequest;

use App\Http\Requests\EmployeeServiceRecord\EmployeeServiceRecordCreateForm;
use App\Http\Requests\EmployeeServiceRecord\EmployeeServiceRecordEditForm;

use App\Http\Requests\EmployeeTraining\EmployeeTrainingCreateForm;
use App\Http\Requests\EmployeeTraining\EmployeeTrainingEditForm;


class EmployeeController extends Controller{



    protected $employee;
    protected $employee_sr;
    protected $employee_trng;



    public function __construct(EmployeeService $employee, EmployeeServiceRecordService $employee_sr, EmployeeTrainingService $employee_trng){

        $this->employee = $employee;
        $this->employee_sr = $employee_sr;
        $this->employee_trng = $employee_trng;

    }
	



    // Employee Master
	public function index(EmployeeFilterRequest $request){

    	return $this->employee->fetch($request);
    
    }

    


    public function create(){

        return view('dashboard.employee.create');

    }

    


    public function store(EmployeeFormRequest $request){

    	return $this->employee->store($request);
        
    }




    public function show($slug){

        return $this->employee->show($slug);
        
    }




    public function edit($slug){

    	return $this->employee->edit($slug);
        
    }




    public function update(EmployeeFormRequest $request, $slug){

    	return $this->employee->update($request, $slug);

    }

    


    public function destroy($slug){

    	return $this->employee->destroy($slug);

    }




    public function printPDS($slug, $page){

        return $this->employee->printPDS($slug, $page);

    }




    // Service Record
    public function serviceRecord($slug){

        return $this->employee_sr->index($slug);

    }




    public function serviceRecordStore(EmployeeServiceRecordCreateForm $request, $slug){

        return $this->employee_sr->store($request, $slug);

    }




    public function serviceRecordUpdate(EmployeeServiceRecordEditForm $request, $emp_slug, $emp_sr_slug){
        
        return $this->employee_sr->update($request, $emp_slug, $emp_sr_slug); 

    }




    public function serviceRecordDestroy($slug){
        
        return $this->employee_sr->destroy($slug);

    }




    public function serviceRecordPrint($slug){
        
        return $this->employee_sr->print($slug);

    }



    // Trainings
    public function training($slug){

        return $this->employee_trng->index($slug);

    }




    public function trainingStore(EmployeeTrainingCreateForm $request, $slug){

        return $this->employee_trng->store($request, $slug);

    }




    public function trainingUpdate(EmployeeTrainingEditForm $request, $emp_slug, $emp_trng_slug){
        
        return $this->employee_trng->update($request, $emp_slug, $emp_trng_slug); 

    }




    public function trainingDestroy($slug){
        
        return $this->employee_trng->destroy($slug);

    }




    public function trainingPrint($slug){
        
        return $this->employee_trng->print($slug);

    }




    public function report(){
        
        return view('dashboard.employee.report');
    }




    public function reportGenerate(EmployeeReportRequest $request){
        
        return $this->employee->reportGenerate($request);

    }




    
}
