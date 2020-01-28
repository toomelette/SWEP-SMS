<?php

namespace App\Http\Controllers;

use App\Swep\Services\EmailContactService;
use App\Http\Requests\EmailContact\EmailContactFormRequest;
use App\Http\Requests\EmailContact\EmailContactFilterRequest;

class EmailContactController extends Controller{




    protected $email_contact;




    public function __construct(EmailContactService $email_contact){

        $this->email_contact = $email_contact;

    }







    public function index(EmailContactFilterRequest $request){

        return $this->email_contact->fetch($request);
        
    }



    public function create(){

        return view('dashboard.email_contact.create');

    }

    


    public function store(EmailContactFormRequest $request){

        return $this->email_contact->store($request);
        
    }




    public function edit($slug){

        return $this->email_contact->edit($slug);
        
    }




    public function update(EmailContactFormRequest $request, $slug){

        return $this->email_contact->update($request, $slug);

    }

    


    public function destroy($slug){

       return $this->email_contact->destroy($slug); 

    }



    
}
