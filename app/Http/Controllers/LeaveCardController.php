<?php

namespace App\Http\Controllers;

use App\Swep\Services\LeaveCardService;
use App\Http\Requests\LeaveCardFormRequest;
use App\Http\Requests\LeaveCardFilterRequest;

class LeaveCardController extends Controller{
    



	protected $leave_card;



    public function __construct(LeaveCardService $leave_card){

        $this->leave_card = $leave_card;

    }



    public function index(LeaveCardFilterRequest $request){

        return $this->leave_card->fetchAll($request);
    
    }




    public function create(){

        return view('dashboard.leave_card.create');
    
    }




    public function createOvertime(){

        return view('dashboard.leave_card.create_overtime');
    
    }




    public function createUndertime(){

        return view('dashboard.leave_card.create_undertime');
    
    }




    public function createTardy(){

        return view('dashboard.leave_card.create_tardy');
    
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

	
	


}
