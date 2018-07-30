<?php

namespace App\Swep\ViewComposers;


use View;
use App\Swep\Interfaces\SignatoryInterface;


class SignatoryComposer{
   


	protected $signatory_repo;



	public function __construct(SignatoryInterface $signatory_repo){

		$this->signatory_repo = $signatory_repo;

	}





    public function compose($view){

        $signatories = $this->signatory_repo->globalFetchAll();

        $signatory_types = $this->signatory_repo->globalStaticTypes();
        
    	$view->with([
    		'global_signatories_all' => $signatories,
    		'global_static_signatory_types' => $signatory_types,
    	]);

    }






}