<?php

namespace App\Swep\Interfaces;
 


interface LeaveCardInterface {

	public function fetch($request);

	public function store($request, $year, $month, $days, $hrs, $mins, $credits);

	public function update($request, $year, $month, $days, $hrs, $mins, $credits, $slug);

	public function destroy($slug);

	public function findBySlug($slug);
		
}