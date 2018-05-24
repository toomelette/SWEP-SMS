<?php

namespace App\Swep\ViewComposers;


use View;
use Illuminate\Cache\Repository as Cache;


class SignatoryTypeComposer{
   

	protected $cache;


	public function __construct(Cache $cache){

		$this->cache = $cache;
	
	}



    public function compose($view){

      $types = $this->cache->remember('signatories:global:static:types', 240, function(){
      	return [
            '1 - ASSISTANT ADMINISTRATOR' => '1',
            '2 - ACCOUNTING VIS' => '2',
            '3 - HRU VIS' => '3',
            '4 - PROPERTY VIS' => '4',
            '5 - RECORDS VIS' => '5',
            '6 - TBM VIS' => '6',
            '7 - LMD VIS' => '7',
            '8 - SRED VIS' => '8',
            '9 - LEGAL VIS' => '9',
            '10 - RDE VIS' => '10',
            '11 - SOILS VIS' => '11',
            '12 - SUGAR VIS' => '12',
          ];
      });
        
    	$view->with('global_static_signatory_types', $types);

    }




}