<?php
 
namespace App\Swep\Services;

use App\Models\Employee;
use App\Models\EmployeeTraining;
use App\Swep\BaseClasses\BaseService;



class EmployeeTrainingService extends BaseService{


    protected $employee;
    protected $employee_trng;



    public function __construct(Employee $employee, EmployeeTraining $employee_trng){

        $this->employee = $employee;
        $this->employee_trng = $employee_trng;
        parent::__construct();

    }





    public function index($slug){

        $employee = $this->employeeBySlug($slug);

        $employee_trainings = $this->cache->remember('employees:trainings:byEmpNo:'. $employee->employee_no, 240, function() use ($employee){
            return $this->employee_trng->populateByEmpNo($employee->employee_no);
        });

        return view('dashboard.employee.training')->with(['employee' => $employee, 'employee_trainings' => $employee_trainings,]);

    }




    public function store($request, $slug){

        $employee = $this->employeeBySlug($slug);
        $employee_trng = new EmployeeTraining;
        $employee_trng->slug = $this->str->random(32);
        $employee_trng->employee_no = $employee->employee_no;
        $employee_trng->title = $request->title;
        $employee_trng->type = $request->type;
        $employee_trng->date_from = $this->dataTypeHelper->date_in($request->date_from);
        $employee_trng->date_to = $this->dataTypeHelper->date_in($request->date_to);
        $employee_trng->hours = $request->hours;
        $employee_trng->conducted_by = $request->conducted_by;
        $employee_trng->venue = $request->venue;
        $employee_trng->remarks = $request->remarks;
        $employee_trng->created_at = $this->carbon->now();
        $employee_trng->updated_at = $this->carbon->now();
        $employee_trng->ip_created = request()->ip();
        $employee_trng->ip_updated = request()->ip();
        $employee_trng->user_created = $this->auth->user()->user_id;
        $employee_trng->user_updated = $this->auth->user()->user_id;
        $employee_trng->save();

        $this->event->fire('employee_training.store', $employee_trng);
        return redirect()->route('dashboard.employee.training', $employee->slug);

    }




    public function update($request, $emp_slug, $emp_trng_slug){
        
        $employee = $this->employeeBySlug($emp_slug);
        $employee_trng = $this->employee_trng->findSlug($emp_trng_slug);
        $employee_trng->title = $request->e_title;
        $employee_trng->type = $request->e_type;
        $employee_trng->date_from = $this->dataTypeHelper->date_in($request->e_date_from);
        $employee_trng->date_to = $this->dataTypeHelper->date_in($request->e_date_to);
        $employee_trng->hours = $request->e_hours;
        $employee_trng->conducted_by = $request->e_conducted_by;
        $employee_trng->venue = $request->e_venue;
        $employee_trng->remarks = $request->e_remarks;
        $employee_trng->updated_at = $this->carbon->now();
        $employee_trng->ip_updated = request()->ip();
        $employee_trng->user_updated = $this->auth->user()->user_id;
        $employee_trng->save();

        $this->event->fire('employee_training.update', $employee_trng);
        return redirect()->route('dashboard.employee.training', $employee->slug);

    }




    public function destroy($slug){

        $employee_trng = $this->employee_trng->findSlug($slug);
        $employee_trng->delete();

        $this->event->fire('employee_training.destroy', $employee_trng);
        return redirect()->back();

    }




    public function print($slug){

        $employee = $this->employeeBySlug($slug);

        $employee_trainings = $this->cache->remember('employees:trainings:byEmpNo:'. $employee->employee_no, 240, function() use ($employee){
            return $this->employee_trng->populateByEmpNo($employee->employee_no);
        });

        return view('printables.employee_training')->with(['employee' => $employee, 'employee_trainings' => $employee_trainings,]);
    }



    // Utility
    public function employeeBySlug($slug){

        $employee = $this->cache->remember('employees:bySlug:' . $slug, 240, function() use ($slug){
            return $this->employee->findSlug($slug);
        });
        
        return $employee;

    }





}