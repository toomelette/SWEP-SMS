<?php

namespace App\Swep\ViewComposers;


use View;
use App\Models\Signatories;
use Illuminate\Cache\Repository as Cache;


class SignatoriesComposer{
   

	protected $signatory;
	protected $cache;


	public function __construct(Signatories $signatory, Cache $cache){
		$this->signatory = $signatory;
		$this->cache = $cache;
	}



    public function compose($view){

        $signatory = $this->cache->remember('signatories:all', 240, function(){
        	return $this->signatory->select('employee_name', 'employee_position', 'type')->get();
        });
        
    	$view->with('global_signatories_all', $signatory);

    }




}