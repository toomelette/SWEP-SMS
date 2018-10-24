<?php

namespace App\Swep\ViewComposers;


use View;
use App\Swep\Interfaces\ProjectCodeInterface;
use Illuminate\Cache\Repository as Cache;


class ProjectCodeComposer{
   


	protected $project_code_repo;




	public function __construct(ProjectCodeInterface $project_code_repo){

		$this->project_code_repo = $project_code_repo;
	
	}





    public function compose($view){

        $project_codes = $this->project_code_repo->getAll();
        
    	$view->with('global_project_codes_all', $project_codes);

    }






}