<?php
 
namespace App\Swep\Services;

use Hash;
use App\Models\User;
use App\Swep\BaseClasses\BaseService;



class ProfileService extends BaseService{


	protected $user;



    public function __construct(User $user){

        $this->user = $user;
        parent::__construct();

    }





    public function updateAccountUsername($request, $slug){

        $user = $this->userBySlug($slug);
        $request->flash();
        $this->event->fire('profile.update_account_username', [$user, $request]);
        $this->session->flash('PROFILE_UPDATE_ACCOUNT_SUCCESS', 'Your account has been successfully updated! Please sign in again.');
        return redirect('/');

    }






    public function updateAccountPassword($request, $slug){
        
        $user = $this->userBySlug($slug);
        $request->flash();

        if(Hash::check($request->old_password, $this->auth->user()->password)){

            $this->event->fire('profile.update_account_password', [$user, $request]);
            $this->session->flash('PROFILE_UPDATE_ACCOUNT_SUCCESS', 'Your account has been successfully updated! Please sign in again.');
            return redirect('/');

        }

        $this->session->flash('PROFILE_OLD_PASSWORD_FAIL', 'The old password you provided does not match.');
        return redirect()->back();

    }






    public function updateAccountColor($request, $slug){

        $user = $this->userBySlug($slug);
        $request->flash();
        $this->event->fire('profile.update_account_color', [$user, $request]);
        $this->session->flash('PROFILE_UPDATE_ACCOUNT_COLOR_SUCCESS', 'Color Scheme successfully set!');
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