<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Cache\Repository as Cache;
use App\Models\EmployeeServiceRecord;
use App\Models\EmployeeTraining;
use Illuminate\Http\Request;



class ApiEmployeeController extends Controller{


	protected $cache;
	protected $employee_sr;
	protected $employee_trng;





	public function __construct(Cache $cache, EmployeeServiceRecord $employee_sr, EmployeeTraining $employee_trng){

		$this->cache = $cache;
		$this->employee_sr = $employee_sr;
		$this->employee_trng = $employee_trng;

	}






	public function editServiceRecord(Request $request, $slug){

    	if($request->Ajax()){

    		$response_employee_sr = $this->cache->remember('api:employees:service_records:bySlug:'. $slug .'', 240, function() use ($slug){
        		return $this->employee_sr->where('slug', $slug)->get();
       		});

	    	return json_encode($response_employee_sr);
	    }

	    return abort(404);

    }






    public function editTraining(Request $request, $slug){

    	if($request->Ajax()){

    		$response_employee_trng = $this->cache->remember('api:employees:trainings:bySlug:'. $slug .'', 240, function() use ($slug){
        		return $this->employee_trng->where('slug', $slug)->get();
       		});

	    	return json_encode($response_employee_trng);
	    }

	    return abort(404);

    }




    
}
