<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Swep\Services\EmployeeService;
use App\Http\Requests\EmployeeFormRequest;



class EmployeeController extends Controller{



    protected $employee;



    public function __construct(EmployeeService $employee){

        $this->employee = $employee;

    }
	




	public function index(Request $request){

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




    
}
