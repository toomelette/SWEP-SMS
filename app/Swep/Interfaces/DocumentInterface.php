<?php

namespace App\Swep\Interfaces;
 


interface DocumentInterface {

	public function fetchAll($request);

	public function fetchByFolderCode($folder_code);

	public function store($request, $filename);

	public function update($request, $filename, $document);

	public function destroy($document);

	public function findBySlug($slug);
		
}