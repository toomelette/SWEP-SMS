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






    public function findBySubmenuId($submenu_id){

        $submenu = $this->cache->remember('submenus:bySubmenuId:' . $submenu_id, 240, function() use ($submenu_id){
            return $this->submenu->where('submenu_id', $submenu_id)->first();
        });
        
        return $submenu;

    }






}