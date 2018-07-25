<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\MenuInterface;


use App\Models\Menu;


class MenuRepository extends BaseRepository implements MenuInterface {
	


    protected $menu;



	public function __construct(Menu $menu){

        $this->menu = $menu;

        parent::__construct();

    }






    public function findByMenuId($menu_id){

        $menu = $this->cache->remember('menus:byMenuId:' . $menu_id, 240, function() use ($menu_id){
            return $this->menu->where('menu_id', $menu_id)->first();
        });
        
        return $menu;

    }






}