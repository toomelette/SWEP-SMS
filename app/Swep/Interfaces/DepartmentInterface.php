<?php

namespace App\Swep\Interfaces;
 


interface DepartmentInterface {

	public function fetchAll($request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);

	public function findBySlug($slug);

	public function globalFetchAll();

	public function apiGetByDepartmentId($dept_id);
		
}