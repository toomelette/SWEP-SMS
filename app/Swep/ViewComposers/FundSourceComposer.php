<?php

namespace App\Swep\ViewComposers;


use View;
use App\Models\FundSource;
use Illuminate\Cache\Repository as Cache;


class FundSourceComposer{
   

	protected $fund_source;
	protected $cache;


	public function __construct(FundSource $fund_source, Cache $cache){
		$this->fund_source = $fund_source;
		$this->cache = $cache;
	}



    public function compose($view){

        $fund_source = $this->cache->remember('fund_sources:global:all', 240, function(){
        	return $this->fund_source->select('fund_source_id', 'description')->get();
        });
        
    	$view->with('global_fund_source_all', $fund_source);

    }




}