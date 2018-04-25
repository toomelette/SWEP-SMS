<?php 

namespace App\Swep\Subscribers;

use Auth;
use Hash;
use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\UserMenu;
use App\Models\UserSubMenu;
use Illuminate\Support\Str;
use App\Swep\Helpers\CacheHelper;



class ProfileSubscriber{


	protected $user;
	protected $menu;
	protected $submenu;
	protected $user_menu;
	protected $carbon;
	protected $auth;
    protected $str;
    protected $cache;



	public function __construct(User $user, Menu $menu, SubMenu $submenu, UserMenu $user_menu, UserSubMenu $user_submenu, Carbon $carbon, Str $str){

		$this->user = $user;
		$this->menu = $menu;
		$this->submenu = $submenu;
		$this->user_menu = $user_menu;
		$this->user_submenu = $user_submenu;
		$this->carbon = $carbon;
        $this->str = $str;
		$this->auth = auth();

	}



	public function subscribe($events){

		$events->listen('profile.update_account', 'App\Swep\Subscribers\ProfileSubscriber@onUpdateAccount');

	}



    public function onUpdateAccount($user, $request){

        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->is_online = 0;
        $user->save();

		Session::flush();
        $this->auth->logout();

        CacheHelper::deletePattern('swep_cache:user:all:*');
        CacheHelper::deletePattern('swep_cache:user:bySlug:'. $user->slug .'');
        CacheHelper::deletePattern('swep_cache:user_menu:byUserId:'. $user->user_id .'');

    }




}