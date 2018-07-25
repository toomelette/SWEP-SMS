<?php

namespace App\Swep\Interfaces;
 


interface ProfileInterface {

	public function updateUsername($request, $slug);

	public function updatePassword($request, $slug);

	public function updateColor($request, $slug);
		
}