<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Swep\Services\ProfileService;
use App\Http\Requests\ProfileUpdateAccountRequest;


class ProfileController extends Controller{



	protected $profile_service; 



    public function __construct(ProfileService $profile_service){

        $this->profile_service = $profile_service;

    }




	public function details(){

        return view('dashboard.profile.details');
        
    }




    public function updateAccount(ProfileUpdateAccountRequest $request, $slug){

        return $this->profile_service->updateAccount($request, $slug);
        
    }




    
}
