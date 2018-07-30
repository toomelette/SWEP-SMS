<?php

namespace App\Swep\Interfaces;
 


interface UserMenuInterface {

	public function store($user, $menu);

	public function globalFetchByCategory($cat);
		
}