<?php

namespace App\Providers;
 
use Illuminate\Support\ServiceProvider;
 

class RepositoryServiceProvider extends ServiceProvider {
	


	public function register(){

		$this->app->bind('App\Swep\Interfaces\UserInterface', 'App\Swep\Repositories\UserRepository');
		$this->app->bind('App\Swep\Interfaces\EmployeeInterface', 'App\Swep\Repositories\EmployeeRepository');
		$this->app->bind('App\Swep\Interfaces\MenuInterface', 'App\Swep\Repositories\MenuRepository');
		$this->app->bind('App\Swep\Interfaces\SubmenuInterface', 'App\Swep\Repositories\SubmenuRepository');
		$this->app->bind('App\Swep\Interfaces\ProfileInterface', 'App\Swep\Repositories\ProfileRepository');
	
	}



}