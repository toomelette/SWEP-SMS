<?php

namespace App\Swep\ViewComposers;


use View;
use App\Swep\Interfaces\EmailContactInterface;


class EmailContactComposer{
   


	protected $email_contact_repo;



	public function __construct(EmailContactInterface $email_contact_repo){

		$this->email_contact_repo = $email_contact_repo;
		
	}





    public function compose($view){

        $email_contacts = $this->email_contact_repo->getAll();
        
    	$view->with('global_email_contacts_all', $email_contacts);

    }





}