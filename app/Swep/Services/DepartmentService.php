<?php
 
namespace App\Swep\Services;


use App\Swep\Interfaces\DepartmentInterface;
use App\Swep\BaseClasses\BaseService;



class DepartmentService extends BaseService{



    protected $department_repo;



    public function __construct(DepartmentInterface $department_repo){

        $this->department_repo = $department_repo;
        parent::__construct();

    }





    public function fetchAll($request){

        $departments = $this->department_repo->fetchAll($request);

        $request->flash();
        return view('dashboard.department.index')->with('departments', $departments);

    }






    public function store($request){

        $department = $this->department_repo->store($request);

        $this->event->fire('department.store');
        return redirect()->back();

    }





    public function edit($slug){

        $department = $this->department_repo->findBySlug($slug);
        return view('dashboard.department.edit')->with('department', $department);

    }





    public function update($request, $slug){

        $department = $this->department_repo->update($request, $slug);

        $this->event->fire('department.update', $department);
        return redirect()->route('dashboard.department.index');

    }





    public function destroy($slug){

        $department = $this->department_repo->destroy($slug);

        $this->event->fire('department.destroy', $department );
        return redirect()->route('dashboard.department.index');

    }







}