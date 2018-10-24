<?php
 
namespace App\Swep\Services;


use App\Swep\Interfaces\PermissionSlipInterface;
use App\Swep\Interfaces\DepartmentInterface;
use App\Swep\Interfaces\EmployeeInterface;
use App\Swep\BaseClasses\BaseService;



class PermissionSlipService extends BaseService{



    protected $ps_repo;
    protected $dept_repo;
    protected $emp_repo;



    public function __construct(PermissionSlipInterface $ps_repo, DepartmentInterface $dept_repo, EmployeeInterface $emp_repo){

        $this->ps_repo = $ps_repo;
        $this->dept_repo = $dept_repo;
        $this->emp_repo = $emp_repo;
        parent::__construct();

    }





    public function fetchAll($request){

        $permission_slips = $this->ps_repo->fetchAll($request);

        $request->flash();
        return view('dashboard.permission_slip.index')->with('permission_slips', $permission_slips);

    }






    public function store($request){

        $permission_slip = $this->ps_repo->store($request);

        $this->event->fire('ps.store');
        return redirect()->back();

    }






    public function show($slug){

        $permission_slip = $this->ps_repo->findBySlug($slug);
        return view('dashboard.permission_slip.show')->with('permission_slip', $permission_slip);

    }






    public function edit($slug){

        $permission_slip = $this->ps_repo->findBySlug($slug);
        return view('dashboard.permission_slip.edit')->with('permission_slip', $permission_slip);

    }






    public function update($request, $slug){

        $permission_slip = $this->ps_repo->update($request, $slug);

        $this->event->fire('ps.update', $permission_slip);
        return redirect()->route('dashboard.permission_slip.index');

    }






    public function destroy($slug){

        $permission_slip = $this->ps_repo->destroy($slug);

        $this->event->fire('ps.destroy', $permission_slip);
        return redirect()->route('dashboard.permission_slip.index');

    }






    public function reportGenerate($request){

        $df = $this->__dataType->date_parse($request->df, 'Y-m-d');
        $dt = $this->__dataType->date_parse($request->dt, 'Y-m-d');

        $department = $this->dept_repo->findByDepartmentId($request->d);

        $employees = $this->ps_repo->fetchEmployeeByDepartmentIdWithMonthlyPS($request->d, $df, $dt);

        return view('printables.permission_slip.monthly_report', compact(['department', 'employees']));

    }






}   