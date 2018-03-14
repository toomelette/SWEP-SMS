<?php

namespace App\Http\Controllers\Auth;


use Auth;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



class LoginController extends Controller{
   


    use AuthenticatesUsers;


    protected $redirectTo = 'admin/home';



    public function __construct(){

        $this->middleware('guest')->except('logout');
    
    }


    
    public function username(){

        return 'username';
    
    }



    protected function login(Request $request){

        $remember = $request->has('remember') ? true : false;

        if (Auth::attempt($this->credentials($request), $remember)){

            if(Auth::user()->is_active == false){

                Session::flash('IS_UNACTIVATED','Your account is currently UNACTIVATED! Please contact the IT Personel to activate your account.');
                Auth::logout();

            }elseif(Auth::user()->is_logged == true){

                Session::flash('IS_AUTHENTICATED','Your account is currently log-in to another device!  Please logout your account in the another device and try again.');
                Auth::logout();

            }else{

                return redirect()->intended('admin/home');

            }
        
        }

        return $this->sendFailedLoginResponse($request);        

    }




}
