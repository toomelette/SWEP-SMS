<?php

namespace App\Swep\ViewComposers;


use View;
use App\Swep\Interfaces\DisbursementVoucherInterface;
use Illuminate\Cache\Repository as Cache;


class DisbursementVoucherComposer{
   

	protected $dv_repo;


	public function __construct(DisbursementVoucherInterface $dv_repo){
		
		$this->dv_repo = $dv_repo;
	
	}



    public function compose($view){

        $mop = $this->dv_repo->getModeOfPayment();

    	$view->with('global_dv_mode_of_payment', $mop);

    }




}