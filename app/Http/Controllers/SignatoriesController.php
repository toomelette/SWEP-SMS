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

        return view('dashboard.signatories.create');
        
    }

    


    public function store(SignatoriesFormRequest $request){

        return $this->signatory->store($request);
        
    }

   



    public function show($id){


        
    }

    



    public function edit($slug){

        return $this->signatory->edit($slug);
        
    }

    



    public function update(SignatoriesFormRequest $request, $slug){

        return $this->signatory->update($request, $slug);
        
    }




    public function destroy($slug){
        
        return $this->signatory->destroy($slug);

    }




}
