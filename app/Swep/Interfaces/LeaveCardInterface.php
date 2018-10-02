<?php

namespace App\Swep\Interfaces;
 


interface LeaveCardInterface {

	public function fetchAll($request);

	public function store($request, $days, $hrs, $mins, $credits);

	public function update($request, $days, $hrs, $mins, $credits, $slug);

	public function destroy($slug);

	public function findBySlug($slug);
		
}