<?php

namespace App\Swep\ViewComposers;


use App\Swep\Interfaces\ProjectInterface;
use View;


class ProjectComposer{
   


	protected $project;



	public function __construct(ProjectInterface $project){

		$this->project = $project;

	}





    public function compose($view){

        $projects = $this->project->getAll();
        
    	$view->with('global_projects_all', $projects);

    }






}