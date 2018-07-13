<?php

namespace App\Swep\ViewComposers;


use View;
use App\Models\Submenu;
use Illuminate\Cache\Repository as Cache;


class SubmenuComposer{
   

	protected $submenu;
	protected $cache;



	public function __construct(Submenu $submenu, Cache $cache){

		$this->submenu = $submenu;
		$this->cache = $cache;

	}



    public function compose($view){

        $submenus = $this->cache->remember('submenus:global:all', 240, function(){
        	return $this->submenu->select('menu_id','submenu_id', 'name', 'is_nav')->orderBy('submenu_id', 'asc')->get();
        });
        
    	$view->with('global_submenus_all', $submenus);

    }




}