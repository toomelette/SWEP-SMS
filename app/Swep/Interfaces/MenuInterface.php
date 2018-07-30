<?php

namespace App\Swep\Interfaces;
 


interface MenuInterface {

	public function fetchAll($request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);

	public function findBySlug($menu_id);

	public function findByMenuId($menu_id);

	public function globalFetchAll();
		
}