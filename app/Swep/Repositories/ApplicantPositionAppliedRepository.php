<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\ApplicantPositionAppliedInterface;


use App\Models\ApplicantPositionApplied;


class ApplicantPositionAppliedRepository extends BaseRepository implements ApplicantPositionAppliedInterface {
	



    protected $applicant_pa;




	public function __construct(ApplicantPositionApplied $applicant_pa){

        $this->applicant_pa = $applicant_pa;
        parent::__construct();

    }






    public function globalFetchAll(){

        $applicant_pa = $this->cache->remember('applicant_pa:global:all', 240, function(){
            return $this->applicant_pa->select('applicant_pa_id', 'position')->get();
        });
        
        return $applicant_pa;

    }






}