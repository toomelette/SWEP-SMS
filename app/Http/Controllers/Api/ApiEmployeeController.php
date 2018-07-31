<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;


use App\Swep\Interfaces\EmployeeServiceRecordInterface;
use App\Swep\Interfaces\EmployeeTrainingInterface;
use Illuminate\Http\Request;




class ApiEmployeeController extends Controller{



	protected $employee_sr_repo;
	protected $employee_trng_repo;






	public function __construct(EmployeeServiceRecordInterface $employee_sr_repo, EmployeeTrainingInterface $employee_trng_repo){

		$this->employee_sr_repo = $employee_sr_repo;
		$this->employee_trng_repo = $employee_trng_repo;

	}







	public function editServiceRecord(Request $request, $slug){

    	if($request->Ajax()){
    		$response_employee_sr = $this->employee_sr_repo->apiGetBySlug($slug);
	    	return json_encode($response_employee_sr);
	    }

	    return abort(404);

    }







    public function editTraining(Request $request, $slug){

    	if($request->Ajax()){
    		$response_employee_trng = $this->employee_trng_repo->apiGetBySlug($slug);
	    	return json_encode($response_employee_trng);
	    }

	    return abort(404);

    }






    
}
