<?php

namespace App\Swep\ViewComposers;


use View;
use App\Swep\Interfaces\ApplicantPositionAppliedInterface;


class ApplicantPositionAppliedComposer{
   


	protected $applicant_pa_repo;



	public function __construct(ApplicantPositionAppliedInterface $applicant_pa_repo){

		$this->applicant_pa_repo = $applicant_pa_repo;
		
	}





    public function compose($view){

        $applicant_pa_repo = $this->applicant_pa_repo->globalFetchAll();
        
    	$view->with('global_applicant_pa_all', $applicant_pa_repo);

    }





}