<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Swep\Services\LeaveApplicationService;
use App\Http\Requests\LeaveApplicationFormRequest;


class LeaveApplicationController extends Controller{

    

    protected $leave_application;



    public function __construct(LeaveApplicationService $leave_application){

        $this->leave_application = $leave_application;

    }



    public function index(Request $request){

        return $this->leave_application->fetchAll($request);
    
    }

    


    public function userIndex(Request $request){

        return $this->leave_application->fetchByUser($request);
    
    }




    public function create(){

        return view('dashboard.leave_application.create');
    
    }

    



    public function store(LeaveApplicationFormRequest $request){

        return $this->leave_application->store($request);
        
    }

    



    public function show($slug){

        return $this->leave_application->show($slug);
        
    }




    
    public function edit($slug){

        return $this->leave_application->edit($slug);
        
    }

    


    
    public function update(LeaveApplicationFormRequest $request, $slug){

        return $this->leave_application->update($request, $slug);
        
    }

    



    public function destroy($slug){
        
        return $this->leave_application->destroy($slug);

    }





    public function print($slug, $type){
        
        return $this->leave_application->print($slug, $type);

    }




}
