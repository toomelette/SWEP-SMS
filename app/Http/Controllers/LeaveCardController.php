<?php

namespace App\Http\Controllers;

use App\Swep\Services\LeaveCardService;
use App\Http\Requests\LeaveCard\LeaveCardFormRequest;
use App\Http\Requests\LeaveCard\LeaveCardFilterRequest;
use App\Http\Requests\LeaveCard\LeaveCardReportRequest;

class LeaveCardController extends Controller{
    



	protected $leave_card;



    public function __construct(LeaveCardService $leave_card){

        $this->leave_card = $leave_card;

    }



    public function index(LeaveCardFilterRequest $request){

        return $this->leave_card->fetch($request);
    
    }




    public function create(){

        return view('dashboard.leave_card.create');
    
    }
    



    public function store(LeaveCardFormRequest $request){

        return $this->leave_card->store($request);
        
    }
    



    public function show($slug){

        return $this->leave_card->show($slug);
        
    }




    
    public function edit($slug){

        return $this->leave_card->edit($slug);
        
    }

    


    
    public function update(LeaveCardFormRequest $request, $slug){

        return $this->leave_card->update($request, $slug);
        
    }

    



    public function destroy($slug){
        
        return $this->leave_card->destroy($slug);

    }

    



    public function report(){

        return view('dashboard.leave_card.report');

    }

    



    public function reportGenerate(LeaveCardReportRequest $request){
        
        return $this->leave_card->reportGenerate($request);

    }


	
	


}
