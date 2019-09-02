<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\LeaveApplicationInterface;
use App\Swep\Interfaces\SignatoryInterface;


use App\Models\LeaveApplication;


class LeaveApplicationRepository extends BaseRepository implements LeaveApplicationInterface {
	



    protected $leave_application;
    protected $signatory_repo;




	public function __construct(LeaveApplication $leave_application, SignatoryInterface $signatory_repo){

        $this->leave_application = $leave_application;
        $this->signatory_repo = $signatory_repo;
        parent::__construct();

    }






    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $leave_applications = $this->cache->remember('leave_applications:fetch:' . $key, 240, function() use ($request, $entries){
            $leave_application = $this->requestFilter($request);
            return $this->populate($leave_application, $entries);
        });

        return $leave_applications;

    }







    public function fetchByUser($request){

        $key = str_slug($request->fullUrl(), '_');

        $leave_applications = $this->cache->remember('leave_applications:fetchByUser:'. $this->auth->user()->user_id .':' . $key, 240, function() use ($request){
            $leave_application = $this->requestFilter($request);
            return $this->populateByUser($leave_application, $this->auth->user()->user_id);
        });

        return $leave_applications;

    }







    public function store($request){

        $leave_application = new LeaveApplication;
        $leave_application->slug = $this->str->random(32);
        $leave_application->user_id = $this->auth->user()->user_id;
        $leave_application->leave_application_id = $this->getLeaveApplicationIdInc();
        $leave_application->doc_no = 'LA' . rand(10000000, 99999999);
        $leave_application->lastname = $request->lastname;
        $leave_application->firstname = $request->firstname;
        $leave_application->middlename = $request->middlename;
        $leave_application->date_of_filing = $this->__dataType->date_parse($request->date_of_filing);
        $leave_application->position = $request->position;
        $leave_application->salary = $this->__dataType->string_to_num($request->salary);
        $leave_application->type = $request->type;
        $leave_application->type_vacation = $request->type_vacation;
        $leave_application->type_vacation_others_specific = $request->type_vacation_others_specific;
        $leave_application->type_others_specific = $request->type_others_specific;
        $leave_application->spent_vacation = $request->spent_vacation;
        $leave_application->spent_vacation_abroad_specific = $request->spent_vacation_abroad_specific;
        $leave_application->spent_sick = $request->spent_sick;
        $leave_application->spent_sick_inhospital_specific = $request->spent_sick_inhospital_specific;
        $leave_application->spent_sick_outpatient_specific = $request->spent_sick_outpatient_specific;
        $leave_application->working_days = $request->working_days;
        $leave_application->working_days_date_from = $this->__dataType->date_parse($request->working_days_date_from);
        $leave_application->working_days_date_to = $this->__dataType->date_parse($request->working_days_date_to);
        $leave_application->commutation = $this->__dataType->string_to_boolean($request->commutation);
        $leave_application->immediate_superior = $request->immediate_superior;
        $leave_application->immediate_superior_position = $request->immediate_superior_position;
        $leave_application->personnel_officer = $this->signatory_repo->findByType('3')->employee_name;
        $leave_application->personnel_officer_position = $this->signatory_repo->findByType('3')->employee_position;
        $leave_application->authorized_official = $this->signatory_repo->findByType('1')->employee_name;
        $leave_application->authorized_official_position = $this->signatory_repo->findByType('1')->employee_position;
        $leave_application->created_at = $this->carbon->now();
        $leave_application->updated_at = $this->carbon->now();
        $leave_application->ip_created = request()->ip();
        $leave_application->ip_updated = request()->ip();
        $leave_application->user_created = $this->auth->user()->user_id;
        $leave_application->user_updated = $this->auth->user()->user_id;
        $leave_application->save();

        return $leave_application;

    }







    public function update($request, $slug){

        $leave_application = $this->findBySlug($slug);
        $leave_application->lastname = $request->lastname;
        $leave_application->firstname = $request->firstname;
        $leave_application->middlename = $request->middlename;
        $leave_application->date_of_filing = $this->__dataType->date_parse($request->date_of_filing);
        $leave_application->position = $request->position;
        $leave_application->salary = $this->__dataType->string_to_num($request->salary);
        $leave_application->type = $request->type;
        $leave_application->type_vacation = $request->type_vacation;
        $leave_application->type_vacation_others_specific = $request->type_vacation_others_specific;
        $leave_application->type_others_specific = $request->type_others_specific;
        $leave_application->spent_vacation = $request->spent_vacation;
        $leave_application->spent_vacation_abroad_specific = $request->spent_vacation_abroad_specific;
        $leave_application->spent_sick = $request->spent_sick;
        $leave_application->spent_sick_inhospital_specific = $request->spent_sick_inhospital_specific;
        $leave_application->spent_sick_outpatient_specific = $request->spent_sick_outpatient_specific;
        $leave_application->working_days = $request->working_days;
        $leave_application->working_days_date_from = $this->__dataType->date_parse($request->working_days_date_from);
        $leave_application->working_days_date_to = $this->__dataType->date_parse($request->working_days_date_to);
        $leave_application->commutation = $this->__dataType->string_to_boolean($request->commutation);
        $leave_application->immediate_superior = $request->immediate_superior;
        $leave_application->immediate_superior_position = $request->immediate_superior_position;
        $leave_application->updated_at = $this->carbon->now();
        $leave_application->ip_updated = request()->ip();
        $leave_application->user_updated = $this->auth->user()->user_id;
        $leave_application->save();

        return $leave_application;

    }







    public function destroy($slug){

        $leave_application = $this->findBySlug($slug);
        $leave_application->delete();

        return $leave_application;

    }
    






    public function findBySlug($slug){

        $leave_application = $this->cache->remember('leave_applications:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->leave_application->where('slug', $slug)->first();
        });
        
        if(empty($leave_application)){
            abort(404);
        }
        
        return $leave_application;

    }







    public function requestFilter($request){

        $df = $this->__dataType->date_parse($request->df);
        $dt = $this->__dataType->date_parse($request->dt);

        $leave_application = $this->leave_application->newQuery();

        if(isset($request->q)){
           $this->search($leave_application ,$request->q);
        }

        if(isset($request->t)){
            $leave_application->whereType($request->t);
        }

        if(isset($request->df) || isset($request->dt)){
            $leave_application->whereBetween('date_of_filing', [$df, $dt]);
        }

        return $leave_application;

    }







    public function search($model, $key){

        $model->where(function ($model) use ($key) {
            $model->where('lastname', 'LIKE', '%'. $key .'%')
                  ->orwhere('firstname', 'LIKE', '%'. $key .'%')
                  ->orwhere('middlename', 'LIKE', '%'. $key .'%')
                  ->orwhereHas('user', function ($model) use ($key) {
                    $model->where('username', 'LIKE', '%'. $key .'%');
                });
        });

    }







    public function populate($model, $entries){

        return $model->select('user_id', 'firstname', 'middlename', 'lastname', 'type', 'date_of_filing', 'slug')
                     ->sortable()
                     ->with('user')
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }






    public function populateByUser($model, $id){

        return $model->select('type', 'date_of_filing', 'slug')
                     ->where('user_id', $id)
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }






    public function getLeaveApplicationIdInc(){

        $id = 'LA1000001';

        $la = $this->leave_application->select('leave_application_id')->orderBy('leave_application_id', 'desc')->first();

        if($la != null){

            if($la->leave_application_id != null){
                $num = str_replace('LA', '', $la->leave_application_id) + 1;
                $id = 'LA' . $num;
            }
            
        }
        
        return $id;
        
    }









}