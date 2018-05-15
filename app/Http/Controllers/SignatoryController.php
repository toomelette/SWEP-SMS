<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Swep\Services\SignatoryService;
use App\Http\Requests\SignatoryFormRequest;


class SignatoryController extends Controller{



    protected $signatory;



    public function __construct(SignatoryService $signatory){

        $this->signatory = $signatory;

    }



    
    public function index(Request $request){

        return $this->signatory->fetchAll($request);
        
    }




    public function create(){

        return view('dashboard.signatory.create');
        
    }

    


    public function store(SignatoryFormRequest $request){

        return $this->signatory->store($request);
        
    }

   



    public function show($id){


        
    }

    



    public function edit($slug){

        return $this->signatory->edit($slug);
        
    }

    



    public function update(SignatoryFormRequest $request, $slug){

        return $this->signatory->update($request, $slug);
        
    }




    public function destroy($slug){
        
        return $this->signatory->destroy($slug);

    }




}
