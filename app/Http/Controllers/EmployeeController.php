<?php

namespace App\Http\Controllers;


use App\Swep\Services\EmployeeService;
use App\Http\Requests\EmployeeFormRequest;
use App\Http\Requests\EmployeeFilterRequest;
use App\Http\Requests\EmployeeServiceRecordCreateForm;
use App\Http\Requests\EmployeeServiceRecordEditForm;
use App\Http\Requests\EmployeeTrainingCreateForm;
use App\Http\Requests\EmployeeTrainingEditForm;


class EmployeeController extends Controller{



    protected $employee;



    public function __construct(EmployeeService $employee){

        $this->employee = $employee;

    }
	




	public function index(EmployeeFilterRequest $request){

    	return $this->employee->fetchAll($request);
    
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




    public function printInfo($slug){

        return $this->employee->printInfo($slug);

    }




    public function serviceRecord($slug){

        return $this->employee->serviceRecord($slug);

    }




    public function serviceRecordStore(EmployeeServiceRecordCreateForm $request, $slug){

        return $this->employee->serviceRecordStore($request, $slug);

    }




    public function serviceRecordUpdate(EmployeeServiceRecordEditForm $request, $emp_slug, $emp_sr_slug){
        
        return $this->employee->serviceRecordUpdate($request, $emp_slug, $emp_sr_slug); 

    }




    public function serviceRecordDestroy($slug){
        
        return $this->employee->serviceRecordDestroy($slug);

    }




    public function serviceRecordPrint($slug){
        
        return $this->employee->serviceRecordPrint($slug);

    }




    public function training($slug){

        return $this->employee->training($slug);

    }




    public function trainingStore(EmployeeTrainingCreateForm $request, $slug){

        return $this->employee->trainingStore($request, $slug);

    }




    public function trainingUpdate(EmployeeTrainingEditForm $request, $emp_slug, $emp_trng_slug){
        
        return $this->employee->trainingUpdate($request, $emp_slug, $emp_trng_slug); 

    }




    public function trainingDestroy($slug){
        
        return $this->employee->trainingDestroy($slug);

    }




    public function trainingPrint($slug){
        
        return $this->employee->trainingPrint($slug);

    }




    
}
