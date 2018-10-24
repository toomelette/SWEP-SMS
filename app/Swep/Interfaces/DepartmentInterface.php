<?php

namespace App\Swep\Interfaces;
 


interface DepartmentInterface {

	public function fetch($request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);

	public function findBySlug($slug);

	public function findByDepartmentId($dept_id);

	public function getAll();

	public function getByDepartmentId($dept_id);
		
}