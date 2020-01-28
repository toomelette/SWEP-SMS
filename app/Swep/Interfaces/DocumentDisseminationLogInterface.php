<?php

namespace App\Swep\Interfaces;
 


interface DocumentDisseminationLogInterface {

	public function store($request, $employee_no, $email_contact_id, $document_id, $email, $status);
		
}