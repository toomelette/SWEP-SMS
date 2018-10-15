<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\ApplicantTrainingInterface;


use App\Models\ApplicantTraining;


class ApplicantTrainingRepository extends BaseRepository implements ApplicantTrainingInterface {
	



    protected $applicant_trng;




	public function __construct(ApplicantTraining $applicant_trng){

        $this->applicant_trng = $applicant_trng;
        parent::__construct();

    }





    public function store($data, $applicant){
        
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






}