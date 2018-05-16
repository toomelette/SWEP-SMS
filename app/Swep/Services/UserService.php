<?php
 
namespace App\Swep\Services;


use Hash;
use App\Models\User;
use App\Swep\BaseClasses\BaseService;



class UserService extends BaseService{



	protected $user;



    public function __construct(User $user){

        $this->user = $user;
        parent::__construct();

    }





    public function fetchAll($request){

        $key = str_slug($request->fullUrl(), '_');

        $users = $this->cache->remember('user:all:' . $key, 240, function() use ($request){

            $user = $this->user->newQuery();
            
            if($request->q != null){
                $user->search($request->q);
            }
            
            if($request->ol != null){
                $user->filterIsOnline($request->ol);
            }

            if($request->a != null){
                 $user->filterIsActive($request->a);
            }

            return $user->populate();

        });

        $request->flash();
        
        return view('dashboard.user.index')->with('users', $users);

    }






    public function store($request){

        if(!$this->user->usernameExist($request->username) == 1){

            $this->event->fire('user.create', $request);
            $this->session->flash('USER_CREATE_SUCCESS', 'The User has been successfully created!');
            return redirect()->back();

        }

        $this->session->flash('USER_FORM_FAIL_USERNAME_EXIST', 'The username you provided is already used by an existing account. Please provide another username.');
        return redirect()->back()->withInput();

    }






    public function show($slug){
        
        $user = $this->userBySlug($slug);  
        return view('dashboard.user.show')->with('user', $user);

    }






    public function edit($slug){

    	$user = $this->userBySlug($slug);  
        return view('dashboard.user.edit')->with('user', $user);

    }






    public function update($request, $slug){

        $user = $this->userBySlug($slug);  
        $this->event->fire('user.update', [$user, $request]);
        $this->session->flash('USER_UPDATE_SUCCESS', 'The User has been successfully updated!');
        $this->session->flash('USER_UPDATE_SUCCESS_SLUG', $user->slug);
        return redirect()->route('dashboard.user.index');

    }






    public function delete($slug){

        $user = $this->userBySlug($slug);  
        $user->delete();
        $this->event->fire('user.delete', $user);
        $this->session->flash('USER_DELETE_SUCCESS', 'User successfully removed!');
        return redirect()->back();

    }






    public function activate($slug){

        $user = $this->userBySlug($slug);  

        if($user->is_active == 0){

            $user->update(['is_active' => 1]);
            $this->event->fire('user.activate', $user);
            $this->session->flash('USER_ACTIVATE_SUCCESS', 'User successfully activated!');
            $this->session->flash('USER_ACTIVATE_SUCCESS_SLUG', $user->slug);
            return redirect()->back();

        }

        return redirect()->back();

    }






    public function deactivate($slug){

        $user = $this->userBySlug($slug);  

        if($user->is_active == 1){

            $user->update(['is_active' => 0, 'is_online' => 0]);
            $this->event->fire('user.deactivate', $user);
            $this->session->flash('USER_DEACTIVATE_SUCCESS', 'User successfully deactivated!');
            $this->session->flash('USER_DEACTIVATE_SUCCESS_SLUG', $user->slug);
            return redirect()->back();

        }

        return redirect()->back();

    }






    public function logout($slug){

        $user = $this->userBySlug($slug);  

        if($user->is_active == 1 && $user->is_online == 1){

            $user->update(['is_online' => 0]);
            $this->event->fire('user.logout', $user);
            $this->session->flash('USER_LOGOUT_SUCCESS', 'User successfully logout!');
            $this->session->flash('USER_LOGOUT_SUCCESS_SLUG', $user->slug);
            return redirect()->back();

        }

        return redirect()->back();

    }






    public function resetPassword($slug){

        $user = $this->userBySlug($slug);  
        return view('dashboard.user.reset_password')->with('user', $user);

    }






    public function resetPasswordPost($request, $slug){

        $user = $this->userBySlug($slug);  

        if ($request->username == $this->auth->user()->username && Hash::check($request->user_password, $this->auth->user()->password)) {
            
            if($user->username == $this->auth->user()->username){

                $this->session->flash('USER_RESET_PASSWORD_OWN_ACCOUNT_FAIL', 'Please refer to profile page if you want to reset your own password.');
                return redirect()->back();

            }else{

                $this->event->fire('user.reset_password', [$request, $user]);
                $this->session->flash('USER_RESET_PASSWORD_SUCCESS', 'User password successfully reset!');
                $this->session->flash('USER_RESET_PASSWORD_SLUG', $user->slug);
                return redirect()->route('dashboard.user.index');

            }
            
        }

        $this->session->flash('USER_RESET_PASSWORD_CONFIRMATION_FAIL', 'The credentials you provided does not match the current user!');
        return redirect()->back();

    }





    // Utility Methods

    public function userBySlug($slug){

        $user = $this->cache->remember('user:bySlug:' . $slug, 240, function() use ($slug){
            return $this->user->findSlug($slug);
        }); 
        
        return $user;

    }





}