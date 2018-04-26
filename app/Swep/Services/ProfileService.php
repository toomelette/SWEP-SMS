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




    public function updateAccountUsername(Request $request, $slug){

        $user = $this->cache->remember('user:bySlug:' . $slug, 240, function() use ($slug){
            return $this->user->findSlug($slug);
        });

        $request->flash();

        $this->event->fire('profile.update_account_username', [$user, $request]);
        $this->session->flash('PROFILE_UPDATE_ACCOUNT_SUCCESS', 'Your account has been successfully updated! Please sign in again.');
        return redirect('/');

    }




    public function updateAccountPassword(Request $request, $slug){
        
        $user = $this->cache->remember('user:bySlug:' . $slug, 240, function() use ($slug){
            return $this->user->findSlug($slug);
        });

        $request->flash();

        if(Hash::check($request->old_password, $this->auth->user()->password)){

            $this->event->fire('profile.update_account_password', [$user, $request]);
            $this->session->flash('PROFILE_UPDATE_ACCOUNT_SUCCESS', 'Your account has been successfully updated! Please sign in again.');
            return redirect('/');

        }

        $this->session->flash('PROFILE_OLD_PASSWORD_FAIL', 'The old password you provided does not match.');
        return redirect()->back();

    }




    public function updateAccountColor(Request $request, $slug){
        
        $user = $this->cache->remember('user:bySlug:' . $slug, 240, function() use ($slug){
            return $this->user->findSlug($slug);
        });

        $request->flash();

        $this->event->fire('profile.update_account_color', [$user, $request]);
        $this->session->flash('PROFILE_UPDATE_ACCOUNT_COLOR_SUCCESS', 'Color Scheme successfully set!');
        return redirect()->back();

    }




}