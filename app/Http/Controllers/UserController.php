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




    public function index(){

        return view('dashboard.user.index');

    }

    


    public function create(){

        return view('dashboard.user.create');

    }

    


    public function store(Request $request){

        return $this->user_service->store($request);    

    }

    


    public function show($id){

        

    }

    


    public function edit($id){

        

    }

    


    public function update(Request $request, $id){


        
    }

    


    public function destroy($id){


        
    }



}
