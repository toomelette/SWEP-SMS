<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Swep\Services\EmployeeService;



class EmployeeController extends Controller{



    protected $employee;



    public function __construct(EmployeeService $employee){

        $this->employee = $employee;

    }
	




	public function index(Request $request){

    	return $this->employee->fetchAll($request);
    
    }

    


    public function create(){

        

    }

    


    public function store(Request $request){

    	
        
    }




    public function show($slug){

        return $this->employee->show($slug);
        
    }




    public function edit($slug){

    	
        
    }




    public function update(Request $request, $slug){

    	

    }

    


    public function destroy($slug){

    	

    }




    
}
