<?php

namespace App\Swep\Interfaces;
 


interface EmployeeInterface {

	public function findBySlug($slug);

	public function findByUserId($user_id);
		
}