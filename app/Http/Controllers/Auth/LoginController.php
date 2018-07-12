<?php

namespace App\Http\Controllers\Auth;


use Auth;
use Session;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Swep\Helpers\CacheHelper;
use Illuminate\Events\Dispatcher;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller{
   

    use AuthenticatesUsers;

    protected $auth;
    protected $session;
    protected $carbon;
    protected $user;
    protected $cacheHelper;
    protected $event;
    protected $redirectTo = 'dashboard/home';
    protected $maxAttempts = 4;
    protected $decayMinutes = 2;





    public function __construct(Carbon $carbon, User $user, CacheHelper $cacheHelper, Dispatcher $event){

        $this->auth = auth();
        $this->session = session();
        $this->carbon = $carbon;
        $this->user = $user;
        $this->cacheHelper = $cacheHelper;
        $this->event = $event;

        $this->middleware('guest')->except('logout');

    }





    
    public function username(){

        return 'username';
    
    }






    protected function login(Request $request){

        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }


        if($this->auth->guard()->attempt($this->credentials($request))){

            if($this->auth->user()->is_active == false){

                $this->session->flush();
                $this->session->flash('AUTH_UNACTIVATED','Your account is currently UNACTIVATED! Please contact the designated IT Personel to activate your account.');
                $this->auth->logout();

            }elseif($this->auth->user()->is_online == true){

                $this->session->flush();
                $this->session->flash('AUTH_AUTHENTICATED','Your account is currently log-in to another device!  Please logout your account and try again.');
                $this->auth->logout();

            }else{

                $user = $this->user->find($this->auth->user()->id);
                $this->loginDefaults($user);

                $this->cacheHelper->deletePattern('swep_cache:users:all:*');
                $this->cacheHelper->deletePattern('swep_cache:users:bySlug:'. $user->slug .'');

                $this->clearLoginAttempts($request);
                return redirect()->intended('dashboard/home');

            }
        
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);

    }






    public function logout(Request $request){
        
        if($request->isMethod('post')){

            $user = $this->user->find($this->auth->user()->id);
            
            $user->is_online = 0;
            $user->save();
            
            $this->session->flush();
            $this->guard()->logout();
            $request->session()->invalidate();

            $this->cacheHelper->deletePattern('swep_cache:users:all:*');
            $this->cacheHelper->deletePattern('swep_cache:users:bySlug:'. $user->slug .'');

            return redirect('/');

        }
        
        return abort(404);

    }






    // Defaults

    public function loginDefaults($user){

        $user->is_online = 1;
        $user->last_login_time = $this->carbon->now();
        $user->last_login_machine = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $user->last_login_ip = request()->ip();
        $user->save();

    }







}
