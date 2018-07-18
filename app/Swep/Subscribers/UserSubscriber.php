<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class UserSubscriber extends BaseSubscriber{




	public function __construct(){

        parent::__construct();

    }




	public function subscribe($events){

		$events->listen('user.store', 'App\Swep\Subscribers\UserSubscriber@onStore');
        $events->listen('user.update', 'App\Swep\Subscribers\UserSubscriber@onUpdate');
        $events->listen('user.destroy', 'App\Swep\Subscribers\UserSubscriber@onDestroy');
        $events->listen('user.activate', 'App\Swep\Subscribers\UserSubscriber@onActivate');
        $events->listen('user.deactivate', 'App\Swep\Subscribers\UserSubscriber@onDeactivate');
        $events->listen('user.logout', 'App\Swep\Subscribers\UserSubscriber@onLogout');
        $events->listen('user.reset_password_post', 'App\Swep\Subscribers\UserSubscriber@onResetPasswordPost');

	}





	public function onStore($request, $employee){

        $this->cacheHelper->deletePattern('swep_cache:users:all:*');
        $this->cacheHelper->deletePattern('swep_cache:employees:bySlug:'. $employee->slug .'');
        $this->session->flash('USER_CREATE_SUCCESS', 'The User has been successfully created!');
        
	}





    public function onUpdate($user){

        $this->cacheHelper->deletePattern('swep_cache:users:all:*');
        $this->cacheHelper->deletePattern('swep_cache:users:bySlug:'. $user->slug .'');
        $this->cacheHelper->deletePattern('swep_cache:user_menus:byUserId:'. $user->user_id .':*');
        $this->cacheHelper->deletePattern('swep_cache:nav:user_menus:byUserId:'. $user->user_id .':*');
        $this->cacheHelper->deletePattern('swep_cache:nav:user_submenus:byUserId:'. $user->user_id .':*');

        $this->session->flash('USER_UPDATE_SUCCESS', 'The User has been successfully updated!');
        $this->session->flash('USER_UPDATE_SUCCESS_SLUG', $user->slug);

    }





    public function onDestroy($user){
        
        $this->cacheHelper->deletePattern('swep_cache:users:all:*');
        $this->cacheHelper->deletePattern('swep_cache:users:bySlug:'. $user->slug .'');
        $this->cacheHelper->deletePattern('swep_cache:user_menus:byUserId:'. $user->user_id .':*');
        $this->cacheHelper->deletePattern('swep_cache:nav:user_menus:byUserId:'. $user->user_id .':*');
        $this->cacheHelper->deletePattern('swep_cache:nav:user_submenus:byUserId:'. $user->user_id .':*');

        $this->session->flash('USER_DELETE_SUCCESS', 'User successfully removed!');

    }





    public function onActivate($user){

        $this->cacheHelper->deletePattern('swep_cache:users:all:*');
        $this->cacheHelper->deletePattern('swep_cache:users:bySlug:'. $user->slug .'');
        $this->cacheHelper->deletePattern('swep_cache:user_menus:byUserId:'. $user->user_id .':*');

        $this->session->flash('USER_ACTIVATE_SUCCESS', 'User successfully activated!');
        $this->session->flash('USER_ACTIVATE_SUCCESS_SLUG', $user->slug);

    }





    public function onDeactivate($user){

        $this->cacheHelper->deletePattern('swep_cache:users:all:*');
        $this->cacheHelper->deletePattern('swep_cache:users:bySlug:'. $user->slug .'');
        $this->cacheHelper->deletePattern('swep_cache:user_menus:byUserId:'. $user->user_id .':*');

        $this->session->flash('USER_DEACTIVATE_SUCCESS', 'User successfully deactivated!');
        $this->session->flash('USER_DEACTIVATE_SUCCESS_SLUG', $user->slug);

    }





    public function onLogout($user){

        $this->cacheHelper->deletePattern('swep_cache:users:all:*');
        $this->cacheHelper->deletePattern('swep_cache:users:bySlug:'. $user->slug .'');
        $this->cacheHelper->deletePattern('swep_cache:user_menus:byUserId:'. $user->user_id .':*');

        $this->session->flash('USER_LOGOUT_SUCCESS', 'User successfully logout!');
        $this->session->flash('USER_LOGOUT_SUCCESS_SLUG', $user->slug);

    }





    public function onResetPasswordPost($user){

        $this->cacheHelper->deletePattern('swep_cache:users:all:*');
        $this->cacheHelper->deletePattern('swep_cache:users:bySlug:'. $user->slug .'');
        $this->cacheHelper->deletePattern('swep_cache:user_menus:byUserId:'. $user->user_id .':*');

        $this->session->flash('USER_RESET_PASSWORD_SUCCESS', 'User password successfully reset!');
        $this->session->flash('USER_RESET_PASSWORD_SUCCESS_SLUG', $user->slug);

    }





}