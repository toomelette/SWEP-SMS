<?php

namespace App\Swep\Interfaces;
 


interface DocumentDisseminationLogInterface {

	public function store($request, $employee_no, $department_unit_id, $document_id, $email, $status);
		
}