<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class ProfileSubscriber extends BaseSubscriber{




	public function __construct(){

        parent::__construct();

    }




	public function subscribe($events){

		$events->listen('profile.update_account_username', 'App\Swep\Subscribers\ProfileSubscriber@onUpdateAccountUsername');
		$events->listen('profile.update_account_password', 'App\Swep\Subscribers\ProfileSubscriber@onUpdateAccountPassword');
		$events->listen('profile.update_account_color', 'App\Swep\Subscribers\ProfileSubscriber@onUpdateAccountColor');

	}





    public function onUpdateAccountUsername($user){


         $this->cacheHelper->deletePattern('swep_cache:user:all:*');
         $this->cacheHelper->deletePattern('swep_cache:user:bySlug:'. $user->slug .'');
         $this->cacheHelper->deletePattern('swep_cache:user_menu:byUserId:'. $user->user_id .'');

        $this->session->flash('PROFILE_UPDATE_USERNAME_SUCCESS', 'Your username has been successfully updated! Please sign in again.');

    }





    public function onUpdateAccountPassword($user){

         $this->cacheHelper->deletePattern('swep_cache:user:all:*');
         $this->cacheHelper->deletePattern('swep_cache:user:bySlug:'. $user->slug .'');
         $this->cacheHelper->deletePattern('swep_cache:user_menu:byUserId:'. $user->user_id .'');

        $this->session->flash('PROFILE_UPDATE_PASSWORD_SUCCESS', 'Your password has been successfully updated! Please sign in again.');

    }





    public function onUpdateAccountColor($user){

         $this->cacheHelper->deletePattern('swep_cache:user:all:*');
         $this->cacheHelper->deletePattern('swep_cache:user:bySlug:'. $user->slug .'');
         $this->cacheHelper->deletePattern('swep_cache:user_menu:byUserId:'. $user->user_id .'');

        $this->session->flash('PROFILE_UPDATE_COLOR_SUCCESS', 'Color Scheme successfully set!');

    }





}