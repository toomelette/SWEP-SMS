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






    public function store($request){

        $applicant = new Applicant;
        $applicant->slug = $this->str->random(16);
        $applicant->applicant_id = $this->getApplicantIdInc();
        $applicant->course_id = $request->course_id;
        $applicant->applicant_pa_id = $request->applicant_pa_id;
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