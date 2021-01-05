<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmployeeServiceRecordInterface;
use App\Swep\Interfaces\EmployeeInterface;

use App\Models\EmployeeServiceRecord;


class EmployeeServiceRecordRepository extends BaseRepository implements EmployeeServiceRecordInterface {
	



    protected $employee_sr;
    protected $employee_repo;




	public function __construct(EmployeeServiceRecord $employee_sr, EmployeeInterface $employee_repo){

        $this->employee_sr = $employee_sr;
        $this->employee_repo = $employee_repo;
        parent::__construct();

    }






    public function fetchByEmpNo($slug){

        $employee = $this->employee_repo->findBySlug($slug);


        $employee_service_records = $this->cache->remember('employees:service_records:fetchByEmpNo:'. $employee->employee_no, 240, function() use ($employee){
            $employee_sr = $this->employee_sr->newQuery();
            return $this->populate($employee_sr ,$employee->employee_no);
        });

    
        return ['employee' => $employee, 'employee_service_records' => $employee_service_records];


    }





    public function store($request, $slug){

        $employee = $this->employee_repo->findBySlug($slug);
        $employee_sr = new EmployeeServiceRecord;
        $employee_sr->slug = $this->str->random(32);
        $employee_sr->employee_no = $employee->employee_no;
        $employee_sr->sequence_no = $request->sequence_no;
        $employee_sr->date_from = $request->date_from;
        $employee_sr->date_to = $request->date_to;
        $employee_sr->position = $request->position;
        $employee_sr->appointment_status = $request->appointment_status;
        $employee_sr->salary = $this->__dataType->string_to_num($request->salary);
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

        return $employee_sr;

    }






    public function update($request, $emp_slug, $emp_sr_slug){

        $employee = $this->employee_repo->findBySlug($emp_slug);
        $employee_sr = $this->findBySlug($emp_sr_slug);
        $employee_sr->sequence_no = $request->e_sequence_no;
        $employee_sr->date_from = $request->e_date_from;
        $employee_sr->date_to = $request->e_date_to;
        $employee_sr->position = $request->e_position;
        $employee_sr->appointment_status = $request->e_appointment_status;
        $employee_sr->salary = $this->__dataType->string_to_num($request->e_salary);
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

        return $employee_sr;

    }






    public function destroy($slug){
        
        $employee_sr = $this->findBySlug($slug);
        $employee_sr->delete();

        return $employee_sr;

    }






    public function populate($model, $employee_no){

        return $model->where('employee_no', $employee_no)
                     ->orderBy('sequence_no', 'asc')
                     ->get();

    }





    public function findBySlug($slug){

        $employee_sr = $this->employee_sr->where('slug', $slug)->first(); 

        if(empty($employee_sr)){
            abort(404);
        }

        return $employee_sr;

    }





    public function getBySlug($slug){

        $employee_sr = $this->cache->remember('employees:service_records:getBySlug:'. $slug .'', 240, function() use ($slug){
            return $this->employee_sr->where('slug', $slug)->get();
        });
        
        return $employee_sr;

    }






}