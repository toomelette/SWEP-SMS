<?php 

namespace App\Swep\Subscribers;

use Auth;
use Hash;
use Session;
use App\Swep\Helpers\CacheHelper;



class ProfileSubscriber{


	protected $auth;



	public function __construct(){

		$this->auth = auth();

	}




	public function subscribe($events){

		$events->listen('profile.update_account_username', 'App\Swep\Subscribers\ProfileSubscriber@onUpdateAccountUsername');
		$events->listen('profile.update_account_password', 'App\Swep\Subscribers\ProfileSubscriber@onUpdateAccountPassword');
		$events->listen('profile.update_account_color', 'App\Swep\Subscribers\ProfileSubscriber@onUpdateAccountColor');

	}




    public function onUpdateAccountUsername($user, $request){

        $user->username = $request->username;
        $user->is_online = 0;
        $user->save();

		Session::flush();
        $this->auth->logout();

        CacheHelper::deletePattern('swep_cache:user:all:*');
        CacheHelper::deletePattern('swep_cache:user:bySlug:'. $user->slug .'');
        CacheHelper::deletePattern('swep_cache:user_menu:byUserId:'. $user->user_id .'');

    }




    public function onUpdateAccountPassword($user, $request){

        $user->password = Hash::make($request->password);
        $user->is_online = 0;
        $user->save();

		Session::flush();
        $this->auth->logout();

        CacheHelper::deletePattern('swep_cache:user:all:*');
        CacheHelper::deletePattern('swep_cache:user:bySlug:'. $user->slug .'');
        CacheHelper::deletePattern('swep_cache:user_menu:byUserId:'. $user->user_id .'');

    }




    public function onUpdateAccountColor($user, $request){

        $user->color = $request->color;
        $user->save();

        CacheHelper::deletePattern('swep_cache:user:all:*');
        CacheHelper::deletePattern('swep_cache:user:bySlug:'. $user->slug .'');
        CacheHelper::deletePattern('swep_cache:user_menu:byUserId:'. $user->user_id .'');

    }




}