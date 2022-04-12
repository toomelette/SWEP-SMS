<?php
 
namespace App\Swep\Services;


use App\Swep\Interfaces\EmailContactInterface;
use App\Swep\BaseClasses\BaseService;



class EmailContactService extends BaseService{



    protected $email_contact_repo;



    public function __construct(EmailContactInterface $email_contact_repo){

        $this->email_contact_repo = $email_contact_repo;
        parent::__construct();

    }





    public function fetch($request){

        $email_contacts = $this->email_contact_repo->fetch($request);

        $request->flash();
        return view('dashboard.email_contact.index')->with('email_contacts', $email_contacts);

    }






    public function store($request){

        $email_contact = $this->email_contact_repo->store($request);

        $this->event->dispatch('email_contact.store', $email_contact);
        return redirect()->back();

    }





    public function edit($slug){

    	$email_contact = $this->email_contact_repo->findBySlug($slug);
        return view('dashboard.email_contact.edit')->with('email_contact', $email_contact);

    }





    public function update($request, $slug){

    	$email_contact = $this->email_contact_repo->update($request, $slug);

        $this->event->dispatch('email_contact.update', $email_contact);
        return redirect()->route('dashboard.email_contact.index');

    }





    public function destroy($slug){

    	$email_contact = $this->email_contact_repo->destroy($slug);

        $this->event->dispatch('email_contact.destroy', $email_contact);
        return redirect()->back();

    }







}