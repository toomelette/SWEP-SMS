<?php

namespace App\Swep\ViewComposers;


use View;
use App\Swep\Interfaces\MenuInterface;


class MenuComposer{
   



	protected $menu_repo;





	public function __construct(MenuInterface $menu_repo){

		$this->menu_repo = $menu_repo;

	}





    public function compose($view){

        $menus = $this->menu_repo->globalFetchAll();
        
    	$view->with('global_menus_all', $menus);

    }






}