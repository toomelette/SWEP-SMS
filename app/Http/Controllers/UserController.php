<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Swep\Services\UserService;
use App\Http\Requests\UserFormRequest;


class UserController extends Controller{

       

    protected $user_service; 



    public function __construct(UserService $user_service){

        $this->user_service = $user_service;

    }




    public function index(Request $request){

        return $this->user_service->fetchAll($request);

    }

    


    public function create(){

        return view('dashboard.user.create');

    }

    


    public function store(UserFormRequest $request){

        return $this->user_service->store($request);    

    }

    


    public function show($id){

        

    }

    


    public function edit($slug){

        return $this->user_service->edit($slug);

    }

    


    public function update(UserFormRequest $request, $slug){

        return $this->user_service->update($request, $slug);
        
    }

    


    public function destroy($id){


        
    }



}
