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

        $user_menus_u = [];
        $user_menus_su = [];
        $user_menus_acctg = [];
        $user_menus_hr = [];

        if($this->auth->check()){

            $user_menus_u = $this->cache->remember('user_menus:byUserId:'. $this->auth->user()->user_id .':u', 240, function(){
              return $this->user_menu->where('user_id', $this->auth->user()->user_id)
                                     ->where('category', 'U')
                                     ->with('userSubMenu')
                                     ->get();
            });

            $user_menus_su = $this->cache->remember('user_menus:byUserId:'. $this->auth->user()->user_id .':su', 240, function(){
              return $this->user_menu->where('user_id', $this->auth->user()->user_id)
                                     ->where('category', 'SU')
                                     ->with('userSubMenu')
                                     ->get();
            });

            $user_menus_acctg = $this->cache->remember('user_menus:byUserId:'. $this->auth->user()->user_id .':acctg', 240, function(){
            	return $this->user_menu->where('user_id', $this->auth->user()->user_id)
                                       ->where('category', 'ACCTG')
                                       ->with('userSubMenu')
                                       ->get();
            });

            $user_menus_hr = $this->cache->remember('user_menus:byUserId:'. $this->auth->user()->user_id .':hr', 240, function(){
              return $this->user_menu->where('user_id', $this->auth->user()->user_id)
                                     ->where('category', 'HR')
                                     ->with('userSubMenu')
                                     ->get();
            });

        }  

    	$view->with([
            'global_user_menus_u' => $user_menus_u,
            'global_user_menus_acctg' => $user_menus_acctg, 
            'global_user_menus_hr' => $user_menus_hr, 
            'global_user_menus_su' => $user_menus_su,
          ]);

    }




}