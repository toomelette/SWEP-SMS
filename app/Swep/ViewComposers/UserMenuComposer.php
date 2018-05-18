<?php

namespace App\Swep\ViewComposers;


use View;
use Auth;
use App\Models\UserMenu;
use Illuminate\Cache\Repository as Cache;

class UserMenuComposer{
   

	protected $user_menu;
	protected $cache;
	protected $auth;



	public function __construct(UserMenu $user_menu, Cache $cache){

		$this->user_menu = $user_menu;
		$this->cache = $cache;
		$this->auth = auth();
	}




    public function compose($view){

        $user_menus = [];

        if($this->auth->check()){
            $user_menus = $this->cache->remember('user_menus:byUserId:'. $this->auth->user()->user_id .'', 240, function(){
            	return $this->user_menu->where('user_id', $this->auth->user()->user_id )->with('userSubMenu')->get();
            });
        }  

    	$view->with('global_user_menus', $user_menus);

    }




}