<?php
 
namespace App\Swep\Services;

use App\Models\Employee;
use App\Models\EmployeeServiceRecord;
use App\Swep\BaseClasses\BaseService;



class EmployeeServiceRecordService extends BaseService{


    protected $employee;
    protected $employee_sr;



    public function __construct(Employee $employee, EmployeeServiceRecord $employee_sr){

        $this->employee = $employee;
        $this->employee_sr = $employee_sr;
        parent::__construct();

    }





    public function index($slug){

        $employee = $this->employeeBySlug($slug);

        $employee_service_records = $this->cache->remember('employees:service_records:byEmpNo:'. $employee->employee_no, 240, function() use ($employee){
            return $this->employee_sr->populateByEmpNo($employee->employee_no);
        });

        return view('dashboard.employee.service_record')->with(['employee' => $employee, 'employee_service_records' => $employee_service_records,]);

    }




    public function store($request, $slug){

        $employee = $this->employeeBySlug($slug);
        $employee_sr = new EmployeeServiceRecord;
        $employee_sr->slug = $this->str->random(32);
        $employee_sr->employee_no = $employee->employee_no;
        $employee_sr->sequence_no = $request->sequence_no;
        $employee_sr->date_from = $request->date_from;
        $employee_sr->date_to = $request->date_to;
        $employee_sr->position = $request->position;
        $employee_sr->appointment_status = $request->appointment_status;
        $employee_sr->salary = $this->dataTypeHelper->string_to_num($request->salary);
        $employee_sr->mode_of_payment = $request->mode_of_payment;
        $employee_sr->station = $request->station;
        $employee_sr->gov_serve = $request->gov_serve;
        $employee_sr->psc_serve = $request->psc_serve;
        $employee_sr->lwp = $request->lwp;
        $employee_sr->spdate = $request->spdate;
        $employee_sr->status = $request->status;
        $employee_sr->remarks = $request->remarks;
        $employee_sr->created_at = $this->carbon->now();
        $employee_sr->updated_at = $this->carbon->now();
        $employee_sr->ip_created = request()->ip();
        $employee_sr->ip_updated = request()->ip();
        $employee_sr->user_created = $this->auth->user()->user_id;
        $employee_sr->user_updated = $this->auth->user()->user_id;
        $employee_sr->save();

        $this->event->fire('employee_service_record.store', $employee_sr);
        return redirect()->route('dashboard.employee.service_record', $employee->slug);

    }




    public function update($request, $emp_slug, $emp_sr_slug){

        $employee = $this->employeeBySlug($emp_slug);
        $employee_sr = $this->employee_sr->findSlug($emp_sr_slug);
        $employee_sr->sequence_no = $request->e_sequence_no;
        $employee_sr->date_from = $request->e_date_from;
        $employee_sr->date_to = $request->e_date_to;
        $employee_sr->position = $request->e_position;
        $employee_sr->appointment_status = $request->e_appointment_status;
        $employee_sr->salary = $this->dataTypeHelper->string_to_num($request->e_salary);
        $employee_sr->mode_of_payment = $request->e_mode_of_payment;
        $employee_sr->station = $request->e_station;
        $employee_sr->gov_serve = $request->e_gov_serve;
        $employee_sr->psc_serve = $request->e_psc_serve;
        $employee_sr->lwp = $request->e_lwp;
        $employee_sr->spdate = $request->e_spdate;
        $employee_sr->status = $request->e_status;
        $employee_sr->remarks = $request->e_remarks;
        $employee_sr->updated_at = $this->carbon->now();
        $employee_sr->ip_updated = request()->ip();
        $employee_sr->user_updated = $this->auth->user()->user_id;
        $employee_sr->save();

        $this->event->fire('employee_service_record.update', $employee_sr);
        return redirect()->route('dashboard.employee.service_record', $employee->slug);

    }




    public function destroy($slug){
        
        $employee_sr = $this->employee_sr->findSlug($slug);
        $employee_sr->delete();

        $this->event->fire('employee_service_record.destroy', $employee_sr);
        return redirect()->back();

    }




    public function print($slug){

        $employee = $this->employeeBySlug($slug);
        return view('printables.employee_service_record')->with('employee', $employee);

    }





    // UTILITY METHODS
    public function employeeBySlug($slug){

        $employee = $this->cache->remember('employees:bySlug:' . $slug, 240, function() use ($slug){
            return $this->employee->findSlug($slug);
        });
        
        return $employee;

    }





}