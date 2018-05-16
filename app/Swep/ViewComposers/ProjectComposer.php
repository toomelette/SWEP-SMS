<?php

namespace App\Swep\ViewComposers;


use View;
use App\Models\Project;
use Illuminate\Cache\Repository as Cache;


class ProjectComposer{
   

	protected $projects;
	protected $cache;


	public function __construct(Project $projects, Cache $cache){
		$this->projects = $projects;
		$this->cache = $cache;
	}



    public function compose($view){

        $projects = $this->cache->remember('projects:global:all', 240, function(){
        	return $this->projects->select('project_id', 'project_address')->get();
        });
        
    	$view->with('global_projects_all', $projects);

    }




}