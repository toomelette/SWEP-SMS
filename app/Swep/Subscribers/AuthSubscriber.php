<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class AuthSubscriber extends BaseSubscriber{




	public function __construct(){

        parent::__construct();

    }




	public function subscribe($events){

		$events->listen('auth.login', 'App\Swep\Subscribers\AuthSubscriber@onLogin');
		$events->listen('auth.logout', 'App\Swep\Subscribers\AuthSubscriber@onLogout');

	}




	public function onLogin($user){

		$this->cacheHelper->deletePattern('swep_cache:user:all:*');
		$this->cacheHelper->deletePattern('swep_cache:user:bySlug:'. $user->slug .'');

	}




	public function onLogout($user){
		
		$this->cacheHelper->deletePattern('swep_cache:user:all:*');
		$this->cacheHelper->deletePattern('swep_cache:user:bySlug:'. $user->slug .'');

	}




}