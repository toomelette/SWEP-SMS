<?php

namespace App\Swep\Interfaces;
 


interface EmployeeTrainingInterface {

	public function fetchByEmployeeNo($slug);

	public function getByEmployeeNoWithFilter($request, $slug);

	public function store($request, $slug);
	
	public function update($request, $slug);
	
	public function destroy($slug);

	public function getBySlug($slug);

}