<?php

namespace App\Swep\Interfaces;
 


interface DocumentInterface {

	public function fetchAll($request);

	public function store($request, $filename);

	// public function update($request, $slug);

	// public function destroy($slug);

	public function findBySlug($slug);
		
}