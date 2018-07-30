<?php

namespace App\Swep\ViewComposers;


use View;
use App\Swep\Interfaces\FundSourceInterface;


class FundSourceComposer{
   


	protected $fund_source_repo;




	public function __construct(FundSourceInterface $fund_source_repo){

		$this->fund_source_repo = $fund_source_repo;

	}





    public function compose($view){

        $fund_source = $this->fund_source_repo->globalFetchAll();
        
    	$view->with('global_fund_source_all', $fund_source);

    }






}