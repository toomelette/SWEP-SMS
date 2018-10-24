<?php

namespace App\Swep\ViewComposers;


use View;
use App\Swep\Interfaces\SubmenuInterface;



class SubmenuComposer{
   


	protected $submenu_repo;




	public function __construct(SubmenuInterface $submenu_repo){

		$this->submenu_repo = $submenu_repo;

	}





    public function compose($view){

        $submenus = $this->submenu_repo->getAll();
        
    	$view->with('global_submenus_all', $submenus);

    }






}