<?php

namespace App\Swep\Interfaces;
 


interface PlantillaInterface {

	public function store($request);

	public function fetchAll($request);

	public function findBySlug($slug);

	public function update($request, $slug);

	public function destroy($slug);

	public function globalFetchAll();
		
}