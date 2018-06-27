<?php

namespace App\Http\Controllers;

use App\Swep\Services\ProjectCodeService;
use App\Http\Requests\ProjectCodeFormRequest;
use App\Http\Requests\ProjectCodeFilterRequest;


class ProjectCodeController extends Controller{



	protected $project_code;



    public function __construct(ProjectCodeService $project_code){

        $this->project_code = $project_code;

    }



    
    public function index(ProjectCodeFilterRequest $request){

    	return $this->project_code->fetchAll($request);
    
    }

    


    public function create(){

        return view('dashboard.project_code.create');

    }

    


    public function store(ProjectCodeFormRequest $request){

    	return $this->project_code->store($request);
        
    }




    public function edit($slug){

    	return $this->project_code->edit($slug);
        
    }




    public function update(ProjectCodeFormRequest $request, $slug){

    	return $this->project_code->update($request, $slug);

    }

    


    public function destroy($slug){

    	return $this->project_code->destroy($slug);

    }




}
