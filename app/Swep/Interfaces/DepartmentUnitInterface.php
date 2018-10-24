<?php

namespace App\Swep\Interfaces;
 


interface DepartmentUnitInterface {

	public function fetch($request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);

	public function findBySlug($slug);

	public function getAll();

	public function getByDepartmentName($dept_name);

	public function getByDepartmentId($dept_id);
		
}