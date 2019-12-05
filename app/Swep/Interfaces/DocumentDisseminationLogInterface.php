<?php

namespace App\Swep\Interfaces;
 


interface DocumentDisseminationLogInterface {

	public function store($request, $employee_no, $document_id, $email, $status);
		
}