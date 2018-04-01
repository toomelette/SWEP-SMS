<?php

namespace App\Swep\ViewComposers;


use View;
use App\Models\Projects;
use Illuminate\Cache\Repository as Cache;


class ProjectsComposer{
   

	protected $projects;
	protected $cache;


	public function __construct(Projects $projects, Cache $cache){
		$this->projects = $projects;
		$this->cache = $cache;
	}



    public function compose($view){

        $projects = $this->cache->remember('projects:all', 240, function(){
        	return $this->projects->select('project_id', 'project_address')->get();
        });
        
    	$view->with('global_projects_all', $projects);

    }




}