<?php

namespace App\Swep\ViewComposers;

use DB;
use View;
use Auth;
use App\UserMenu;
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

        $user_menu = [];

        if($this->auth->check()){

            $user_menu = $this->cache->remember('user_menu:byUserId:'. $this->auth->user()->user_id .'', 240, function(){

            	return $this->user_menu->where('user_id', $this->auth->user()->user_id )->get();

            });

        }
        
    	$view->with('user_menu', $user_menu);
    	
    }




}