<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\SubmenuInterface;


use App\Models\Submenu;


class SubmenuRepository extends BaseRepository implements SubmenuInterface {
	



    protected $submenu;




	public function __construct(Submenu $submenu){

        $this->submenu = $submenu;
        parent::__construct();

    }






    public function store($data, $menu){

        $submenu = new Submenu;
        $submenu->slug = $this->str->random(16);
        $submenu->submenu_id = $this->submenu->submenuIdInc;
        $submenu->menu_id = $menu->menu_id;
        $submenu->name = $data['sub_name'];
        $submenu->route = $data['sub_route'];
        $submenu->is_nav = $this->dataTypeHelper->string_to_boolean($data['sub_is_nav']);  
        $submenu->created_at = $this->carbon->now();
        $submenu->updated_at = $this->carbon->now();
        $submenu->ip_created = request()->ip();
        $submenu->ip_updated = request()->ip();
        $submenu->user_created = $this->auth->user()->user_id;
        $submenu->user_updated = $this->auth->user()->user_id;
        $submenu->save();
        
        return $submenu;

    }






    public function findBySubmenuId($submenu_id){

        $submenu = $this->cache->remember('submenus:bySubmenuId:' . $submenu_id, 240, function() use ($submenu_id){
            return $this->submenu->where('submenu_id', $submenu_id)->first();
        });
        
        return $submenu;

    }





}