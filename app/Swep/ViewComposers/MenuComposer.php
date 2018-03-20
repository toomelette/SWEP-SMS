<?php

namespace App\Swep\ViewComposers;


use View;
use App\Menu;
use Illuminate\Cache\Repository as Cache;


class MenuComposer{
   

	protected $menu;
	protected $cache;



	public function __construct(Menu $menu, Cache $cache){

		$this->menu = $menu;
		$this->cache = $cache;
	}




    public function compose($view){

        $menu_all = $this->cache->remember('menu:all', 240, function(){

        	return $this->menu->select('menu_id', 'name')->get();

        });
        
    	$view->with('menu_all', $menu_all);

    }




}