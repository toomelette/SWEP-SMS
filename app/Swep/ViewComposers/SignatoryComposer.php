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
        
    	$view->with('global_signatories_all', $signatories);

    }






}