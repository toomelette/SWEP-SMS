<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\ApplicantInterface;


use App\Models\Applicant;


class ApplicantRepository extends BaseRepository implements ApplicantInterface {
	



    protected $applicant;




	public function __construct(Applicant $applicant){

        $this->applicant = $applicant;
        parent::__construct();

    }







    public function fetchAll($request){

        $key = str_slug($request->fullUrl(), '_');

        $applicants = $this->cache->remember('applicants:all:' . $key, 240, function() use ($request){

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

            return $this->populate($applicant);

        });

        return $applicants;

    }







    public function store($request){

        $applicant = new Applicant;
        $applicant->slug = $this->str->random(16);
        $applicant->applicant_id = $this->getApplicantIdInc();
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

    }





    public function findBySlug($slug){

        $applicant = $this->cache->remember('applicants:bySlug:' . $slug, 240, function() use ($slug){
            return $this->applicant->where('slug', $slug)->first();
        });

        if(empty($applicant)){
            abort(404);
        }
        
        return $applicant;

    }







    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('lastname', 'LIKE', '%'. $key .'%')
                      ->orWhere('firstname', 'LIKE', '%'. $key .'%')
                      ->orWhere('middlename', 'LIKE', '%'. $key .'%')
                      ->orWhere('address', 'LIKE', '%'. $key .'%')
                      ->orWhere('contact_no', 'LIKE', '%'. $key .'%');
        });

    }







    public function populate($model){

        return $model->select('fullname', 'course_id', 'plantilla_id', 'date_of_birth', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

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






}