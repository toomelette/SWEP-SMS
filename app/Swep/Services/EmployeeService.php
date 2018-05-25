<?php
 
namespace App\Swep\Services;


use App\Models\Employee;
use App\Swep\BaseClasses\BaseService;


class EmployeeService extends BaseService{



	protected $employee;



    public function __construct(Employee $employee){

        $this->employee = $employee;
        parent::__construct();

    }





    public function fetchAll($request){

        $key = str_slug($request->fullUrl(), '_');

        $employees = $this->cache->remember('employees:all:' . $key, 240, function() use ($request){

            $employee = $this->employee->newQuery();
            
            if($request->q != null){
                $employee->search($request->q);
            }

            return $employee->populate();

        });

        $request->flash();
        return view('dashboard.employee.index')->with('employees', $employees);

    }






    public function store($request){



    }





     public function show($slug){

        $employee = $this->employeeBySlug($slug);
        return view('dashboard.employee.show')->with('employee', $employee);

    }





    public function edit($slug){



    }






    public function update($request, $slug){



    }






    public function destroy($slug){


    }





    // Utility Methods

    public function employeeBySlug($slug){

        $employee = $this->cache->remember('employees:bySlug:' . $slug, 240, function() use ($slug){
            return $this->employee->findSlug($slug);
        });
        
        return $employee;

    }






}