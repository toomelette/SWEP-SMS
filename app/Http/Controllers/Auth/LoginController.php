<?php

namespace App\Http\Controllers\Auth;


use Auth;
use Illuminate\Http\Request;
use Illuminate\Events\Dispatcher;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



class LoginController extends Controller{
   


    use AuthenticatesUsers;


    protected $auth;
    protected $event;
    protected $redirectTo = 'dashboard/home';



    public function __construct(Dispatcher $event){

        $this->auth = auth();
        $this->event = $event;

        $this->middleware('guest')->except('logout');

    }



    
    public function username(){

        return 'username';
    
    }




    protected function login(Request $request){

        $this->validateLogin($request);

        if ($this->auth->guard()->attempt($this->credentials($request))){

            $this->event->fire('auth.login');
        
        }

        return $this->sendFailedLoginResponse($request);   

    }





    public function logout(Request $request){

        $this->event->fire('auth.logout', $request);

        $this->guard()->logout();
        
        return redirect('/');

    }





}
