<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Swep\Services\DepartmentService;



class DepartmentController extends Controller{



    protected $department;



    public function __construct(DepartmentService $department){

        $this->department = $department;

    }




    
    public function index(){

        
    
    }

    



    public function create(){

        return view('dashboard.department.create');

    }

    



    public function store(Request $request){

        return $this->department->store($request);
        
    }

   



    public function show($id){


        
    }

    



    public function edit($id){


        
    }

    



    public function update(Request $request, $id){



    }

    
    


    public function destroy($id){

        

    }



}
