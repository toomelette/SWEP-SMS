<?php

namespace App\Swep\ViewComposers;


use View;
use App\Models\ProjectCode;
use Illuminate\Cache\Repository as Cache;


class ProjectCodeComposer{
   

	protected $project_code;
	protected $cache;


	public function __construct(ProjectCode $project_code, Cache $cache){

		$this->project_code = $project_code;
		$this->cache = $cache;
	
	}



    public function compose($view){

        $project_codes = $this->cache->remember('project_codes:global:all', 240, function(){
        	return $this->project_code->select('project_code')->get();
        });
        
    	$view->with('global_project_codes_all', $project_codes);

    }




}