<?php

namespace App\Swep\ViewComposers;


use View;
use App\Models\Menu;
use Illuminate\Cache\Repository as Cache;


class MenuComposer{
   

	protected $menu;
	protected $cache;


	public function __construct(Menu $menu, Cache $cache){
		$this->menu = $menu;
		$this->cache = $cache;
	}



    public function compose($view){

        $menus = $this->cache->remember('menus:global:all', 240, function(){
        	return $this->menu->select('menu_id', 'name')->get();
        });
        
    	$view->with('global_menus_all', $menus);

    }




}