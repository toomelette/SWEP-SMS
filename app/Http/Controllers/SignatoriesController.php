<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Swep\Services\SignatoriesService;
use App\Http\Requests\SignatoriesFormRequest;


class SignatoriesController extends Controller{



    protected $signatory;



    public function __construct(SignatoriesService $signatory){

        $this->signatory = $signatory;

    }



    
    public function index(Request $request){

        return $this->signatory->fetchAll($request);
        
    }




    public function create(){


        
    }

    


    public function store(SignatoriesFormRequest $request){

        return $this->signatory->store($request);
        
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
