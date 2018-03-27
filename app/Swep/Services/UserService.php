<?php
 
namespace App\Swep\Services;

use Hash;
use Input;
use Session;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Events\Dispatcher;


class UserService{


	protected $user;
    protected $event;
    protected $session;
    protected $str;



    public function __construct(User $user, Dispatcher $event, Str $str){

        $this->user = $user;
        $this->event = $event;
        $this->session = session();
        $this->str = $str;


    }




    public function fetchAll(Request $request){

        $user = $this->user->newQuery();
        
        $user->search($request->q);

        $user->filterIsOnline($request->online);

        $user->filterIsActive($request->active);

        $users = $user->populate();

        $request->flash();
        
        return view('dashboard.user.index')->with('users', $users);

    }




    public function store(Request $request){

        if(!$this->user->usernameExist($request->username) == 1){

            $user = new User;
            $user->slug = $this->str->random(16);
            $user->firstname = strtoupper($request->firstname);
            $user->middlename = strtoupper($request->middlename);
            $user->lastname = strtoupper($request->lastname);
            $user->email = $request->email;
            $user->position = strtoupper($request->position);
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();

            $this->event->fire('user.create', [$user, $request]);

            $this->session->flash('USER_CREATE_SUCCESS', 'The User has been successfully created!');
            return redirect()->back();

        }

        $this->session->flash('USER_FORM_FAIL_USERNAME_EXIST', 'The username you provided is already used by an existing account. Please provide another username.');
        return redirect()->back()->withInput();

    }




    public function show($slug){



    }




    public function edit($slug){

    	$user = $this->user->findSlug($slug);

        return view('dashboard.user.edit')->with('user', $user);

    }




    public function update(Request $request, $slug){

        $user = $this->user->findSlug($slug);
        $user->firstname = strtoupper($request->firstname);
        $user->middlename = strtoupper($request->middlename);
        $user->lastname = strtoupper($request->lastname);
        $user->email = $request->email;
        $user->position = strtoupper($request->position);
        $user->username = $request->username;
        $user->save();

        $this->event->fire('user.update', [$user, $request]);

        $this->session->flash('USER_UPDATE_SUCCESS', 'The User has been successfully updated!');
        $this->session->flash('USER_UPDATE_SUCCESS_SLUG', $user->slug);

        return redirect()->route('dashboard.user.index');

    }




    public function delete($slug){

        $user = $this->user->findSlug($slug);
        $user->delete();
        $user->userMenu()->delete();
        $user->userSubmenu()->delete();
        $this->session->flash('USER_DELETE_SUCCESS', 'Record successfully removed!');
        return redirect()->back();

    }




}