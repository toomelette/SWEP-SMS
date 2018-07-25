<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\ProfileInterface;
use App\Swep\Interfaces\UserInterface;


use Hash;
use App\Models\User;


class ProfileRepository extends BaseRepository implements ProfileInterface {
	



    protected $user;
    protected $user_repo;




	public function __construct(User $user, UserInterface $user_repo){

        $this->user = $user;
        $this->user_repo = $user_repo;

        parent::__construct();

    }






    public function updateUsername($request, $slug){

        $user = $this->user_repo->findBySlug($slug);
        $user->username = $request->username;
        $user->is_online = 0;
        $user->save();

        return $user;

    }





    public function updatePassword($request, $slug){

        $user = $this->user_repo->findBySlug($slug);
        $user->password = Hash::make($request->password);
        $user->is_online = 0;
        $user->save();

        return $user;

    }





    public function updateColor($request, $slug){
        
        $user = $this->user_repo->findBySlug($slug);
        $user->color = $request->color;
        $user->save();

        return $user;

    }






}