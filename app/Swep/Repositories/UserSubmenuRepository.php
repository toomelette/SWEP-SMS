<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\UserSubmenuInterface;

use App\Models\UserSubmenu;


class UserSubmenuRepository extends BaseRepository implements UserSubmenuInterface {
	



    protected $user_submenu;




	public function __construct(UserSubmenu $user_submenu){

        $this->user_submenu = $user_submenu;
        parent::__construct();

    }






    public function store($submenu, $user_menu){

        $user_submenu = new UserSubMenu;
        $user_submenu->submenu_id = $submenu->submenu_id;
        $user_submenu->user_menu_id = $user_menu->user_menu_id;
        $user_submenu->user_id = $user_menu->user_id;
        $user_submenu->is_nav = $submenu->is_nav;
        $user_submenu->name = $submenu->name;
        $user_submenu->route = $submenu->route;
        $user_submenu->save();

        return $user_submenu;

    }








}