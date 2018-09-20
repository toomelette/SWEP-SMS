<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmployeeTrainingInterface;
use App\Swep\Interfaces\EmployeeInterface;

use App\Models\EmployeeTraining;


class EmployeeTrainingRepository extends BaseRepository implements EmployeeTrainingInterface {
	



    protected $employee_trng;
    protected $employee_repo;




	public function __construct(EmployeeTraining $employee_trng, EmployeeInterface $employee_repo){

        $this->employee_trng = $employee_trng;
        $this->employee_repo = $employee_repo;
        parent::__construct();

    }






    public function fetchByEmpNo($slug){

        $employee = $this->employee_repo->findBySlug($slug);

        $employee_trngs = $this->cache->remember('employees:trainings:byEmpNo:'. $employee->employee_no, 240, function() use ($employee){
            $employee_trng = $this->employee_trng->newQuery();
            return $this->populate($employee_trng, $employee->employee_no);
        });

        return ['employee' => $employee, 'employee_trainings' => $employee_trngs];

    }






    public function store($request, $slug){

        $employee = $this->employee_repo->findBySlug($slug);
        $employee_trng = new EmployeeTraining;
        $employee_trng->slug = $this->str->random(32);
        $employee_trng->employee_no = $employee->employee_no;
        $employee_trng->title = $request->title;
        $employee_trng->type = $request->type;
        $employee_trng->date_from = $this->__dataType->date_parse($request->date_from);
        $employee_trng->date_to = $this->__dataType->date_parse($request->date_to);
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

        return $employee_trng;

    }






    public function update($request, $emp_slug, $emp_trng_slug){
        
        $employee = $this->employee_repo->findBySlug($emp_slug);
        $employee_trng = $this->findBySlug($emp_trng_slug);
        $employee_trng->title = $request->e_title;
        $employee_trng->type = $request->e_type;
        $employee_trng->date_from = $this->__dataType->date_parse($request->e_date_from);
        $employee_trng->date_to = $this->__dataType->date_parse($request->e_date_to);
        $employee_trng->hours = $request->e_hours;
        $employee_trng->conducted_by = $request->e_conducted_by;
        $employee_trng->venue = $request->e_venue;
        $employee_trng->remarks = $request->e_remarks;
        $employee_trng->updated_at = $this->carbon->now();
        $employee_trng->ip_updated = request()->ip();
        $employee_trng->user_updated = $this->auth->user()->user_id;
        $employee_trng->save();

        return $employee_trng;

    }






    public function destroy($slug){

        $employee_trng = $this->findBySlug($slug);
        $employee_trng->delete();

        return $employee_trng;

    }





    public function populate($model, $employee_no){

        return $model->where('employee_no', $employee_no)
                     ->orderBy('date_from', 'desc')
                     ->get();

    }





    public function findBySlug($slug){
            
        $employee_trng = $this->employee_trng->where('slug', $slug)->first();

        if(empty($employee_trng)){
            abort(404);
        }

        return $employee_trng;

    }





    public function apiGetBySlug($slug){
            
        $employee_trng = $this->cache->remember('api:employees:trainings:bySlug:'. $slug .'', 240, function() use ($slug){
            return $this->employee_trng->where('slug', $slug)->get();
        });

        return $employee_trng;

    }






}