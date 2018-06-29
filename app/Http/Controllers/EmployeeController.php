<?php

namespace App\Http\Controllers;


use App\Swep\Services\EmployeeService;
use App\Http\Requests\EmployeeFormRequest;
use App\Http\Requests\EmployeeFilterRequest;
use App\Http\Requests\EmployeeServiceRecordForm;


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




    public function serviceRecordStore(EmployeeServiceRecordForm $request, $slug){

        return $this->employee->serviceRecordStore($request, $slug);

    }




    public function serviceRecordUpdate(EmployeeServiceRecordForm $request, $slug){

        return $this->employee->serviceRecordUpdate($request, $slug);

    }




    public function serviceRecordDestroy($slug){
        
        return $this->employee->serviceRecordDestroy($slug);

    }




    
}
