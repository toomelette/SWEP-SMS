<?php
 
namespace App\Swep\Services;


use App\Swep\Interfaces\DepartmentUnitInterface;
use App\Swep\BaseClasses\BaseService;



class DepartmentUnitService extends BaseService{



    protected $department_unit_repo;



    public function __construct(DepartmentUnitInterface $department_unit_repo){

        $this->department_unit_repo = $department_unit_repo;
        parent::__construct();

    }





    public function fetch($request){

        $department_units = $this->department_unit_repo->fetch($request);

        $request->flash();
        return view('dashboard.department_unit.index')->with('department_units', $department_units);

    }






    public function store($request){

        $department_unit = $this->department_unit_repo->store($request);

        $this->event->fire('department_unit.store', $department_unit);        
        return redirect()->back();

    }






    public function edit($slug){

        $department_unit = $this->department_unit_repo->findBySlug($slug);
        return view('dashboard.department_unit.edit')->with('department_unit', $department_unit);

    }






    public function update($request, $slug){

        $department_unit = $this->department_unit_repo->update($request, $slug);
        
        $this->event->fire('department_unit.update', $department_unit);
        return redirect()->route('dashboard.department_unit.index');

    }






    public function destroy($slug){

        $department_unit = $this->department_unit_repo->destroy($slug);
        
        $this->event->fire('department_unit.destroy', $department_unit);
        return redirect()->route('dashboard.department_unit.index');

    }






}