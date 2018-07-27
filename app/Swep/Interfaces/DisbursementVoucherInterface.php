<?php

namespace App\Swep\Interfaces;
 


interface DisbursementVoucherInterface {

	public function fetchAll($request);

	public function fetchByUser($request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);

	public function setNo($request, $slug);

	public function confirmCheck($model);

	public function findBySlug($slug);
		
}