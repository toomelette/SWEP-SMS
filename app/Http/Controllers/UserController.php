<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserFormRequest;


class UserController extends Controller{

   
    public function index(){

        return view('dashboard.user.index');

    }

    


    public function create(){

        return view('dashboard.user.create');

    }

    


    public function store(UserFormRequest $request){

        dd($request);
            

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
