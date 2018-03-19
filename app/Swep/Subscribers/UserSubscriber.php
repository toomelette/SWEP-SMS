<?php 

namespace App\Swep\Subscribers;

use Auth;
use Session;
use App\User;
use Carbon\Carbon;



class UserSubscriber{


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

		$events->listen('user.create', 'App\Swep\Subscribers\UserSubscriber@onCreate');

	}




	public function onCreate(){

		

	}








}