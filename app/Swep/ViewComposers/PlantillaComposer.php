<?php

namespace App\Swep\ViewComposers;


use View;
use App\Swep\Interfaces\PlantillaInterface;


class PlantillaComposer{
   


	protected $plantilla_repo;



	public function __construct(PlantillaInterface $plantilla_repo){

		$this->plantilla_repo = $plantilla_repo;
		
	}





    public function compose($view){

        $plantillas = $this->plantilla_repo->globalFetchAll();
        
    	$view->with('global_plantilla_all', $plantillas);

    }





}