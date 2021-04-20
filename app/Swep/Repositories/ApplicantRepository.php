<?php

namespace App\Swep\Repositories;
 
use App\Models\ApplicantPositionApplied;
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\ApplicantInterface;


use App\Models\Applicant;
use App\Models\ApplicantEducationalBackground;
use App\Models\ApplicantExperience;
use App\Models\ApplicantTraining;
use App\Models\ApplicantEligibility;


class ApplicantRepository extends BaseRepository implements ApplicantInterface {
	



    protected $applicant;




	public function __construct(Applicant $applicant){

        $this->applicant = $applicant;
        parent::__construct();

    }







    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');
        $entries = isset($request->e) ? $request->e : 20;

        $applicants = $this->cache->remember('applicants:fetch:' . $key, 240, function() use ($request, $entries){

            $applicant = $this->applicant->newQuery();
            
            if(isset($request->q)){
                $this->search($applicant, $request->q);
            }

            if(isset($request->c)){
                $applicant->whereCourseId($request->c);
            }

            if(isset($request->p)){
                $applicant->wherePlantillaId($request->p);
            }

            if(isset($request->g)){
                $applicant->whereGender($request->g);
            }

            if(isset($request->du)){
                $applicant->whereDepartmentUnit_id($request->du);
            }

            return $this->populate($applicant, $entries);

        });

        return $applicants;

    }







    public function store($request){

        $applicant = new Applicant;
        $applicant->slug = $this->str->random(16);
        $applicant->applicant_id = $this->getApplicantIdInc();
        $applicant->department_unit_id = $request->department_unit_id;
        $applicant->course_id = $request->course_id;
        $applicant->plantilla_id = $request->plantilla_id;
        $applicant->lastname = $request->lastname;
        $applicant->firstname = $request->firstname;
        $applicant->middlename = $request->middlename;
        $applicant->fullname = $this->getRequestFullname($request);
        $applicant->gender = $request->gender;
        $applicant->date_of_birth = $this->__dataType->date_parse($request->date_of_birth);
        $applicant->civil_status = $request->civil_status;
        $applicant->address = $request->address;
        $applicant->contact_no = $request->contact_no;
        $applicant->school = $request->school;
        $applicant->is_on_short_list = false;
        $applicant->received_at = $this->__dataType->date_parse($request->received_at);
        $applicant->remarks = $request->remarks;
        $applicant->created_at = $this->carbon->now();
        $applicant->updated_at = $this->carbon->now();
        $applicant->ip_created = request()->ip();
        $applicant->ip_updated = request()->ip();
        $applicant->user_created = $this->auth->user()->user_id;
        $applicant->user_updated = $this->auth->user()->user_id;
        $applicant->save();

        return $applicant;

    }







    public function update($request, $slug){

        $applicant = $this->findBySlug($slug);
        $applicant->plantilla_id = $request->plantilla_id;
        $applicant->department_unit_id = $request->department_unit_id;
        $applicant->course_id = $request->course_id;
        $applicant->lastname = $request->lastname;
        $applicant->firstname = $request->firstname;
        $applicant->middlename = $request->middlename;
        $applicant->fullname = $this->getRequestFullname($request);
        $applicant->gender = $request->gender;
        $applicant->date_of_birth = $this->__dataType->date_parse($request->date_of_birth);
        $applicant->civil_status = $request->civil_status;
        $applicant->address = $request->address;
        $applicant->contact_no = $request->contact_no;
        $applicant->school = $request->school;
        $applicant->received_at = $this->__dataType->date_parse($request->received_at);
        $applicant->remarks = $request->remarks;
        $applicant->updated_at = $this->carbon->now();
        $applicant->ip_updated = request()->ip();
        $applicant->user_updated = $this->auth->user()->user_id;
        $applicant->save();

        $this->destroyDependencies($applicant);

        return $applicant;

    }






    public function destroy($slug){

        $applicant = $this->findBySlug($slug);
        $applicant->delete();
        
        $this->destroyDependencies($applicant);

        return $applicant;

    }






    public function destroyDependencies($applicant){

        $applicant->applicantEducationalBackground()->delete();
        $applicant->applicantExperience()->delete();
        $applicant->applicantTraining()->delete();
        $applicant->applicantEligibility()->delete();
        $applicant->positionApplied()->delete();
    }





    public function findBySlug($slug){

        $applicant = $this->cache->remember('applicants:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->applicant->where('slug', $slug)->first();
        });

        if(empty($applicant)){
            abort(404);
        }
        
        return $applicant;

    }






    public function addToShortList($slug){

        $applicant = $this->findBySlug($slug);
        $applicant->is_on_short_list = 1;
        $applicant->save();

        return $applicant;

    }






    public function removeToShortList($slug){

        $applicant = $this->findBySlug($slug);
        $applicant->is_on_short_list = 0;
        $applicant->save();

        return $applicant;

    }







    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('lastname', 'LIKE', '%'. $key .'%')
                      ->orWhere('firstname', 'LIKE', '%'. $key .'%')
                      ->orWhere('middlename', 'LIKE', '%'. $key .'%')
                      ->orWhere('address', 'LIKE', '%'. $key .'%')
                      ->orWhere('contact_no', 'LIKE', '%'. $key .'%')
                      ->orWhere('received_at', 'LIKE', '%'. $key .'%');
        });

    }







    public function populate($model, $entries){

        return $model->select('fullname', 'course_id', 'plantilla_id', 'date_of_birth', 'received_at' , 'is_on_short_list', 'slug')
                     ->with('course', 'departmentUnit','positionApplied')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate($entries);

    }
    





    public function getApplicantIdInc(){

        $id = 'AP100001';

        $applicant = $this->applicant->select('applicant_id')->orderBy('applicant_id', 'desc')->first();

        if($applicant != null){

            if($applicant->applicant_id != null){
                $num = str_replace('AP', '', $applicant->applicant_id) + 1;
                $id = 'AP' . $num;
            }
        
        }
        
        return $id;
        
    }





    public function getRequestFullname($request){

       return $request->firstname . " " . substr($request->middlename , 0, 1) . ". " . $request->lastname;

    }






    public function getByCourseId($course_id){

        $applicants = $this->cache->remember('applicants:getByCourseId:'. $course_id .'', 240, function() use ($course_id){

            return $this->applicant->select('fullname', 'address', 'civil_status', 'gender', 'date_of_birth', 'contact_no', 'school', 'remarks', 'received_at', 'course_id', 'applicant_id')
                                   ->with('course', 'departmentUnit')  
                                   ->orderBy('received_at', 'asc')       
                                   ->where('course_id', $course_id)
                                   ->get();

        });
        
        return $applicants;

    }






    public function getByCourseIdShortlist($course_id){

        $applicants = $this->cache->remember('applicants:getByCourseIdShortlist:'. $course_id .'', 240, function() use ($course_id){

            return $this->applicant->select('fullname', 'address', 'civil_status', 'gender', 'date_of_birth', 'contact_no', 'school', 'remarks', 'received_at', 'course_id', 'applicant_id')
                                   ->with('course', 'departmentUnit')           
                                   ->where('course_id', $course_id)            
                                   ->where('is_on_short_list', 1)
                                   ->orderBy('lastname', 'asc') 
                                   ->get();

        });
        
        return $applicants;

    }






    public function getByDeptUnitId($dept_unit_id){

        $applicants = $this->cache->remember('applicants:getByDeptUnitId:'. $dept_unit_id .'', 240, function() use ($dept_unit_id){
                
            return $this->applicant->select('fullname', 'address', 'civil_status', 'gender', 'date_of_birth', 'contact_no', 'school', 'remarks', 'received_at', 'course_id', 'applicant_id')
                                   ->with('course', 'departmentUnit') 
                                   ->orderBy('received_at', 'asc')  
                                   ->where('department_unit_id', $dept_unit_id)
                                   ->get();

        });
        
        return $applicants;

    }






    public function getByDeptUnitIdShortlist($dept_unit_id){

        $applicants = $this->cache->remember('applicants:getByDeptUnitIdShortlist:'. $dept_unit_id .'', 240, function() use ($dept_unit_id){
                
            return $this->applicant->select('fullname', 'address', 'civil_status', 'gender', 'date_of_birth', 'contact_no', 'school', 'remarks', 'received_at',  'course_id', 'applicant_id')
                                   ->with('course', 'departmentUnit') 
                                   ->where('department_unit_id', $dept_unit_id)        
                                   ->where('is_on_short_list', 1)
                                   ->orderBy('lastname', 'asc')  
                                   ->get();

        });
        
        return $applicants;

    }









    // Dependencies
    public function storeEducationalBackground($data, $applicant){
        
        $applicant_edc = new ApplicantEducationalBackground;
        $applicant_edc->applicant_id = $applicant->applicant_id;
        $applicant_edc->course = $data['course'];
        $applicant_edc->school = $data['school'];
        $applicant_edc->units = $data['units'];
        $applicant_edc->graduate_year = $data['graduate_year'];
        $applicant_edc->save();

    }





    public function storeExperience($data, $applicant){
        
        $applicant_exp = new ApplicantExperience;
        $applicant_exp->applicant_id = $applicant->applicant_id;
        $applicant_exp->date_from = $this->__dataType->date_parse($data['date_from']);
        $applicant_exp->date_to = $this->__dataType->date_parse($data['date_to']);
        $applicant_exp->position = $data['position'];
        $applicant_exp->company = $data['company'];
        $applicant_exp->is_gov_service =  $this->__dataType->string_to_boolean($data['is_gov_service']);
        $applicant_exp->save();

    }





    public function storeTrainings($data, $applicant){
        
        $applicant_trng = new ApplicantTraining;
        $applicant_trng->applicant_id = $applicant->applicant_id;
        $applicant_trng->title = $data['title'];
        $applicant_trng->date_from = $this->__dataType->date_parse($data['date_from']);
        $applicant_trng->date_to = $this->__dataType->date_parse($data['date_to']);
        $applicant_trng->venue = $data['venue'];
        $applicant_trng->conducted_by = $data['conducted_by'];
        $applicant_trng->remarks = $data['remarks'];
        $applicant_trng->save();

    }





    public function storeEligibilities($data, $applicant){
        
        $applicant_elig = new ApplicantEligibility;
        $applicant_elig->applicant_id = $applicant->applicant_id;
        $applicant_elig->eligibility = $data['eligibility'];
        $applicant_elig->level = $data['level'];
        $applicant_elig->rating = $data['rating'];
        $applicant_elig->exam_place = $data['exam_place'];
        $applicant_elig->exam_date = $this->__dataType->date_parse($data['exam_date']);
        $applicant_elig->save();

    }

    public function storePositionApplied($position_applied, $slug){
        $applicant_pa = new ApplicantPositionApplied;
        $applicant_pa->applicant_slug = $slug;
        $applicant_pa->position_applied = $position_applied;
        $applicant_pa->save();
    }



    public function getByDate($from, $to, $list_type){
        $applicants = $this->applicant->whereBetween('received_at',[$from,$to])->orderBy('received_at','asc');

        if($list_type == 'SL'){
            $applicants = $applicants->where('is_on_short_list',1);
        }

        $applicants = $applicants->get();

        return $applicants;
    }




}