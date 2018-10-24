<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\ProjectInterface;


use App\Models\Project;


class ProjectRepository extends BaseRepository implements ProjectInterface {
	



    protected $project;




	public function __construct(Project $project){

        $this->project = $project;
        parent::__construct();

    }






    public function getAll(){

        $projects = $this->cache->remember('projects:getAll', 240, function(){
            return $this->project->select('project_id', 'project_address')->get();
        });
        
        return $projects;

    }






}