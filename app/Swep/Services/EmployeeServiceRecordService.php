<?php
 
namespace App\Swep\Services;

use App\Swep\Interfaces\EmployeeServiceRecordInterface;
use App\Swep\BaseClasses\BaseService;



class EmployeeServiceRecordService extends BaseService{



    protected $employee_sr_repo;



    public function __construct(EmployeeServiceRecordInterface $employee_sr_repo){

        $this->employee_sr_repo = $employee_sr_repo;
        parent::__construct();

    }





    public function index($slug){

        $employee_sr = $this->employee_sr_repo->fetchByEmpNo($slug); 

        return view('dashboard.employee.service_record')->with($employee_sr);

    }






    public function store($request, $slug){

        $employee_sr = $this->employee_sr_repo->store($request, $slug);

        $this->event->fire('employee_service_record.store', $employee_sr);
        return redirect()->route('dashboard.employee.service_record', $slug);

    }






    public function update($request, $emp_slug, $emp_sr_slug){

        $employee_sr = $this->employee_sr_repo->update($request, $emp_slug, $emp_sr_slug);

        $this->event->fire('employee_service_record.update', $employee_sr);
        return redirect()->route('dashboard.employee.service_record', $emp_slug);

    }






    public function destroy($slug){
        
        $employee_sr = $this->employee_sr_repo->destroy($slug);

        $this->event->fire('employee_service_record.destroy', $employee_sr);
        return redirect()->back();

    }






    public function print($slug){

        $employee_sr = $this->employee_sr_repo->getByEmpNo($slug); 

        return view('printables.employee.service_record')->with($employee_sr);

    }






}