<?php

namespace App\Http\Controllers;

use App\Swep\Services\MemoService;
use App\Http\Requests\MemoFormRequest;
use App\Http\Requests\MemoFilterRequest;

class MemoController extends Controller{



    protected $memo;



    public function __construct(MemoService $memo){

        $this->memo = $memo;

    }



    
    public function index(MemoFilterRequest $request){

        return $this->memo->fetchAll($request);
    
    }

    


    public function create(){

        return view('dashboard.memo.create');

    }

    


    public function store(MemoFormRequest $request){

        return $this->memo->store($request);
        
    }




    public function edit($slug){

        return $this->memo->edit($slug);
        
    }




    public function show($slug){

        return $this->memo->show($slug);
        
    }




    public function update(MemoFormRequest $request, $slug){

        return $this->memo->update($request, $slug);

    }

    


    public function destroy($slug){

       return $this->memo->destroy($slug); 

    }



    
}
