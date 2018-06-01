<?php
 
namespace App\Swep\Services;


use App\Models\Signatory;
use App\Models\LeaveApplication;
use App\Swep\BaseClasses\BaseService;


class LeaveApplicationService extends BaseService{



    protected $signatory;
	protected $leave_application;



    public function __construct(Signatory $signatory, LeaveApplication $leave_application){

        $this->signatory = $signatory;
        $this->leave_application = $leave_application;
        parent::__construct();

    }





    public function fetchAll($request){

        $key = str_slug($request->fullUrl(), '_');

        $leave_applications = $this->cache->remember('leave_applications:all:' . $key, 240, function() use ($request){

            $la = $this->fetchRequest($request);

            return $la->populate();

        });

        $request->flash();
        return view('dashboard.leave_application.index')->with('leave_applications', $leave_applications);

    }






    public function fetchByUser($request){

        $key = str_slug($request->fullUrl(), '_');

        $leave_applications = $this->cache->remember('leave_applications:byUser:'. $this->auth->user()->user_id .':' . $key, 240, function() use ($request){

            $la = $this->fetchRequest($request);

            return $la->populateByUser($this->auth->user()->user_id);

        });

        $request->flash();
        return view('dashboard.leave_application.user_index')->with('leave_applications', $leave_applications);

    }






    public function store($request){

        $leave_application = new LeaveApplication;
        $leave_application->slug = $this->str->random(32);
        $leave_application->user_id = $this->auth->user()->user_id;
        $leave_application->leave_application_id = $this->leave_application->leaveApplicationIdInc;
        $leave_application->doc_no = 'LA' . rand(10000000, 99999999);
        $leave_application->lastname = $request->lastname;
        $leave_application->firstname = $request->firstname;
        $leave_application->middlename = $request->middlename;
        $leave_application->date_of_filing = $this->dataTypeHelper->date_in($request->date_of_filing);
        $leave_application->position = $request->position;
        $leave_application->salary = $this->dataTypeHelper->string_to_num($request->salary);
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
        $leave_application->working_days_date_from = $this->dataTypeHelper->date_in($request->working_days_date_from);
        $leave_application->working_days_date_to = $this->dataTypeHelper->date_in($request->working_days_date_to);
        $leave_application->commutation = $this->dataTypeHelper->string_to_boolean($request->commutation);
        $leave_application->immediate_superior = $request->immediate_superior;
        $leave_application->immediate_superior_position = $request->immediate_superior_position;
        $leave_application->personnel_officer = $this->signatoryByType('3')->employee_name;
        $leave_application->personnel_officer_position = $this->signatoryByType('3')->employee_position;
        $leave_application->authorized_official = $this->signatoryByType('1')->employee_name;
        $leave_application->authorized_official_position = $this->signatoryByType('1')->employee_position;
        $leave_application->created_at = $this->carbon->now();
        $leave_application->updated_at = $this->carbon->now();
        $leave_application->ip_created = request()->ip();
        $leave_application->ip_updated = request()->ip();
        $leave_application->user_created = $this->auth->user()->username;
        $leave_application->user_updated = $this->auth->user()->username;
        $leave_application->save();

        $this->event->fire('la.store', $leave_application);
        return redirect()->back();

    }






    public function edit($slug){

        $leave_application = $this->leaveApplicationBySlug($slug);
        return view('dashboard.leave_application.edit')->with('leave_application', $leave_application);

    }






    public function update($request, $slug){

        $leave_application = $this->leaveApplicationBySlug($slug);
        $leave_application->lastname = $request->lastname;
        $leave_application->firstname = $request->firstname;
        $leave_application->middlename = $request->middlename;
        $leave_application->date_of_filing = $this->dataTypeHelper->date_in($request->date_of_filing);
        $leave_application->position = $request->position;
        $leave_application->salary = $this->dataTypeHelper->string_to_num($request->salary);
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
        $leave_application->working_days_date_from = $this->dataTypeHelper->date_in($request->working_days_date_from);
        $leave_application->working_days_date_to = $this->dataTypeHelper->date_in($request->working_days_date_to);
        $leave_application->commutation = $this->dataTypeHelper->string_to_boolean($request->commutation);
        $leave_application->immediate_superior = $request->immediate_superior;
        $leave_application->immediate_superior_position = $request->immediate_superior_position;
        $leave_application->updated_at = $this->carbon->now();
        $leave_application->ip_updated = request()->ip();
        $leave_application->user_updated = $this->auth->user()->username;
        $leave_application->save();

        $this->event->fire('la.update', $leave_application);
        return redirect()->back();

    }





    public function show($slug){

        $leave_application = $this->leaveApplicationBySlug($slug);
        return view('dashboard.leave_application.show')->with('leave_application', $leave_application);

    }





    public function destroy($slug){

        $leave_application = $this->leaveApplicationBySlug($slug);
        $leave_application->delete();

        $this->event->fire('la.destroy', $leave_application );
        return redirect()->route('dashboard.leave_application.index');

    }




    public function print($slug, $type){

       $leave_application = $this->leaveApplicationBySlug($slug);

        if($type == 'front'){
            return view('printables.leave_application')->with('leave_application', $leave_application);
        }elseif($type == 'back'){
            return view('printables.leave_application_back');
        }
        return abort(404);

    }




    // Utility Methods

    public function leaveApplicationBySlug($slug){

        $leave_application = $this->cache->remember('leave_applications:bySlug:' . $slug, 240, function() use ($slug){
            return $this->leave_application->findSlug($slug);
        });
        
        return $leave_application;

    }



    public function signatoryByType($type){

        $signatory = $this->cache->remember('signatories:byType:' . $type, 240, function() use ($type){
            return $this->signatory->whereType($type)->first();
        }); 

        return $signatory;

    }




    public function fetchRequest($request){

        $df = $this->carbon->parse($request->df)->format('Y-m-d');
        $dt = $this->carbon->parse($request->dt)->format('Y-m-d');

        $leave_application = $this->leave_application->newQuery();

        if($request->q != null){
           $leave_application->search($request->q);
        }

        if($request->t != null){
            $leave_application->whereType($request->t);
        }

        if($request->df != null || $request->dt != null){
            $leave_application->whereBetween('date_of_filing', [$df, $dt]);
        }

        return $leave_application;

    }





}