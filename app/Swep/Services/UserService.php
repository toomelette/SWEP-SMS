<?php
 
namespace App\Swep\Services;

use Hash;
use Input;
use Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Events\Dispatcher;


class UserService{


	protected $user;
    protected $event;
    protected $session;



    public function __construct(User $user, Dispatcher $event){

        $this->user = $user;
        $this->event = $event;
        $this->session = session();


    }




    public function fetchAll(Request $request){
    	


    }




    public function store(Request $request){

        if(!$this->user->usernameExist($request->username) == 1){

            $user = new User;
            $user->firstname = $request->firstname;
            $user->middlename = $request->middlename;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
            $user->position = $request->position;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();

            $this->event->fire('user.create', [$user, $request]);

        }

        $this->session->flash('USER_CREATE_FAIL_USERNAME_EXIST', 'The username you provided is already used by an existing account. Please provide a another username.');
        return redirect()->back()->withInput();

    }




    public function show($slug){



    }




    public function edit($slug){

    	

    }




    public function update(Request $request, $slug){



    }




    public function delete($slug){



    }




}