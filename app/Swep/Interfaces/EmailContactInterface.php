<?php

namespace App\Swep\Interfaces;
 


interface EmailContactInterface {

	public function fetch($request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);

	public function findBySlug($slug);

	public function findByEmailContactId($id);

	public function getAll();
		
}