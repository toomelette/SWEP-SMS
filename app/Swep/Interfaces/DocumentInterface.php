<?php

namespace App\Swep\Interfaces;
 


interface DocumentInterface {

	public function fetch($request);

	public function fetchByFolderCode($folder_code, $request);

	public function store($request, $filename);

	public function update($request, $filename, $document);

	public function destroy($document);

	public function findBySlug($slug);
		
}