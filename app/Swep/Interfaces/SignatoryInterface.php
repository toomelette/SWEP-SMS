<?php

namespace App\Swep\Interfaces;
 


interface SignatoryInterface {

	public function fetch($request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);

	public function findBySlug($slug);
	
	public function findByType($type);

	public function getAll();


}