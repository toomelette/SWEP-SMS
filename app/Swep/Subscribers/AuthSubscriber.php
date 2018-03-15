<?php

namespace App\Swep\Subscribers;

use Auth;
use Session;
use App\User;
use Carbon\Carbon;



class AuthSubscriber{


	protected $user;
	protected $carbon;
	protected $auth;
	protected $session;



	public function __construct(User $user, Carbon $carbon){

		$this->user = $user;
		$this->carbon = $carbon;
		$this->auth = auth();
		$this->session = session();

	}




	public function subscribe($events){

		$events->listen('auth.login', 'App\Swep\Subscribers\AuthSubscriber@onLogin');
		$events->listen('auth.logout', 'App\Swep\Subscribers\AuthSubscriber@onLogout');

	}




	public function onLogin(){

		if($this->auth->user()->is_active == false){

            $this->session->flash('AUTH_UNACTIVATED','Your account is currently UNACTIVATED! Please contact the designated IT Personel to activate your account.');
            $this->auth->logout();

        }elseif($this->auth->user()->is_logged == true){

            $this->session->flash('AUTH_AUTHENTICATED','Your account is currently log-in to another device!  Please logout your account and try again.');
            $this->auth->logout();

        }else{

        	$user = $this->user->find($this->auth->user()->id);
        	$user->update($this->loginDefaults());
            return redirect()->intended('dashboard/home');

        }

	}




	public function onLogout($request){

		$user = $this->user->find($this->auth->user()->id);
		$user->update(['is_logged' => 0]);
		$request->session()->invalidate();

	}




	public function loginDefaults(){

		return [

			'is_logged' => 1,
			'last_login_time' => $this->carbon->now(),
			'last_login_machine' => gethostname(),
			'last_login_ip' => request()->ip()

		];

	}





}