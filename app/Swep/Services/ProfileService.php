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
        $user->username = $request->username;
        $user->is_online = 0;
        $user->save();

        $this->session->flush();
        $this->auth->logout();

        $this->event->fire('profile.update_account_username', $user);
        return redirect('/');

    }






    public function updateAccountPassword($request, $slug){
        
        $user = $this->userBySlug($slug);

        if(Hash::check($request->old_password, $this->auth->user()->password)){

            $user->password = Hash::make($request->password);
            $user->is_online = 0;
            $user->save();

            $this->session->flush();
            $this->auth->logout();

            $this->event->fire('profile.update_account_password', $user);
            return redirect('/');

        }

        $this->session->flash('PROFILE_OLD_PASSWORD_FAIL', 'The old password you provided does not match.');
        return redirect()->back();

    }






    public function updateAccountColor($request, $slug){

        $user = $this->userBySlug($slug);
        $user->color = $request->color;
        $user->save();

        $this->event->fire('profile.update_account_color', $user);
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