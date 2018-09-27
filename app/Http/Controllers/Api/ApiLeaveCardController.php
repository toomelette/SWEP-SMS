<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Swep\Interfaces\LeaveCardInterface;




class ApiLeaveCardController extends Controller{




	protected $leave_card_repo;





	public function __construct(LeaveCardInterface $leave_card_repo){

        $this->leave_card_repo = $leave_card_repo;

	}







	public function selectLeaveCardByEmployeeNo(Request $request, $emp_no){

    	if($request->Ajax()){
    		$response_leave_cards = $this->leave_card_repo->apiGetByEmployeeNo($emp_no);
	    	return json_encode($response_leave_cards);
	    }

	    return abort(404);
	    
    }







   
}
