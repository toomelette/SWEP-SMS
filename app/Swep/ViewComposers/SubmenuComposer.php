<?php

namespace App\Swep\ViewComposers;


use View;
use App\Submenu;
use Illuminate\Cache\Repository as Cache;


class SubmenuComposer{
   

	protected $submenu;
	protected $cache;



	public function __construct(Submenu $submenu, Cache $cache){

		$this->submenu = $submenu;
		$this->cache = $cache;
	}




    public function compose($view){

        $submenu_all = $this->cache->remember('submenu:all', 240, function(){

        	return $this->submenu->select('menu_id','submenu_id', 'name', 'is_nav')->get();

        });
        
    	$view->with('submenu_all', $submenu_all);

    }




}