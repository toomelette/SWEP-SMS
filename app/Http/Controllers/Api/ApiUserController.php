<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Swep\Interfaces\EmployeeInterface;




class ApiUserController extends Controller{



	protected $employee_repo;





	public function __construct(EmployeeInterface_repo $employee_repo){

		$this->employee_repo = $employee_repo;

	}






	public function responseFromEmployee(Request $request, $slug){

    	if($request->Ajax()){
    		$response_employee = $this->employee_repo->apiGetBySlug($slug);
	    	return json_encode($response_employee);
	    }

	    return abort(404);

    }




    
}
