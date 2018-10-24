<?php

namespace App\Http\Controllers;


use App\Swep\Services\DepartmentService;
use App\Http\Requests\Department\DepartmentFormRequest;
use App\Http\Requests\Department\DepartmentFilterRequest;


class DepartmentController extends Controller{



    protected $department;



    public function __construct(DepartmentService $department){

        $this->department = $department;

    }



    
    public function index(DepartmentFilterRequest $request){

        return $this->department->fetch($request);
    
    }

    


    public function create(){

        return view('dashboard.department.create');

    }

    


    public function store(DepartmentFormRequest $request){

        return $this->department->store($request);
        
    }




    public function edit($slug){

        return $this->department->edit($slug);
        
    }




    public function update(DepartmentFormRequest $request, $slug){

        return $this->department->update($request, $slug);

    }

    


    public function destroy($slug){

       return $this->department->destroy($slug); 

    }




}
