<?php

namespace App\Swep\ViewComposers;


use App\Swep\Interfaces\ProjectInterface;
use View;


class ProjectComposer{
   


	protected $project_repo;



	public function __construct(ProjectInterface $project_repo){

		$this->project_repo = $project_repo;

	}





    public function compose($view){

        $projects = $this->project_repo->getAll();
        
    	$view->with('global_projects_all', $projects);

    }






}