<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\ApplicantEducationalBackgroundInterface;


use App\Models\ApplicantEducationalBackground;


class ApplicantEducationalBackgroundRepository extends BaseRepository implements ApplicantEducationalBackgroundInterface {
	



    protected $applicant_edc;




	public function __construct(ApplicantEducationalBackground $applicant_edc){

        $this->applicant_edc = $applicant_edc;
        parent::__construct();

    }





    public function store($data, $applicant){
        
        $applicant_edc = new ApplicantEducationalBackground;
        $applicant_edc->applicant_id = $applicant->applicant_id;
        $applicant_edc->course = $data['course'];
        $applicant_edc->school = $data['school'];
        $applicant_edc->units = $data['units'];
        $applicant_edc->graduate_year = $data['graduate_year'];
        $applicant_edc->save();

    }






}