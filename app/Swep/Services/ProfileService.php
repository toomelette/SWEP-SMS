<?php
 
namespace App\Swep\Services;

use Auth;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Events\Dispatcher;
use Illuminate\Cache\Repository as Cache;

class ProfileService{


	protected $user;
    protected $event;
    protected $cache;
    protected $auth;
    protected $session;



    public function __construct(User $user, Dispatcher $event, Cache $cache){

        $this->user = $user;
        $this->event = $event;
        $this->cache = $cache;
        $this->auth = auth();
        $this->session = session();

    }




    public function updateAccount(Request $request, $slug){

        $user = $this->cache->remember('user:bySlug:' . $slug, 240, function() use ($slug){
            return $this->user->findSlug($slug);
        });

        $request->flash();

        if (!$this->user->usernameExist($request->username) == 1) {
            
            if(Hash::check($request->old_password, $this->auth->user()->password)){
                $this->event->fire('profile.update_account', [$user, $request]);
                $this->session->flash('PROFILE_UPDATE_ACCOUNT_SUCCESS', 'Your account has been successfully updated.');
                return redirect('/');

            }

            $this->session->flash('PROFILE_OLD_PASSWORD_FAIL', 'The old password you provided does not match.');
            return redirect()->back();
            
        }

        $this->session->flash('PROFILE_USERNAME_EXIST', 'The username you provided is already used by an existing account. Please provide another username.');
        return redirect()->back();

    }






}