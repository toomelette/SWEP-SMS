<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\ApplicantExperienceInterface;


use App\Models\ApplicantExperience;


class ApplicantExperienceRepository extends BaseRepository implements ApplicantExperienceInterface {
	



    protected $applicant_exp;




	public function __construct(ApplicantExperience $applicant_exp){

        $this->applicant_exp = $applicant_exp;
        parent::__construct();

    }





    public function store($data, $applicant){
        
        $applicant_exp = new ApplicantExperience;
        $applicant_exp->applicant_id = $applicant->applicant_id;
        $applicant_exp->date_from = $this->__dataType->date_parse($data['date_from']);
        $applicant_exp->date_to = $this->__dataType->date_parse($data['date_to']);
        $applicant_exp->position = $data['position'];
        $applicant_exp->company = $data['company'];
        $applicant_exp->is_gov_service =  $this->__dataType->string_to_boolean($data['is_gov_service']);
        $applicant_exp->save();

    }






}