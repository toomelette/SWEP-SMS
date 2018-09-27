<?php

namespace App\Swep\Interfaces;
 


interface LeaveCardInterface {

	//public function fetchAll($request);

	//public function fetchByUser($request);

	public function store($request, $days, $hrs, $mins, $credits, $balance_sick, $balance_vacation, $balance_overtime);

	//public function update($request, $slug);

	//public function destroy($slug);

	//public function findBySlug($slug);

	public function apiGetByEmployeeNo($emp_no);
		
}