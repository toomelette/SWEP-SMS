<?php

namespace App\Swep\Interfaces;
 


interface UserInterface {
	
	public function fetch($request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);

	public function activate($slug);

	public function deactivate($slug);

	public function logout($slug);

	public function resetPassword($model, $request);

	public function sync($model, $request);

	public function unsync($slug);
	
	public function findBySlug($slug);

	public function login($slug);
		
}