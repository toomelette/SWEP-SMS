<?php

namespace App\Swep\Interfaces;
 


interface EmployeeInterface {

	public function fetchAll($request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);

	public function findBySlug($slug);

	public function findByUserId($user_id);
		
}