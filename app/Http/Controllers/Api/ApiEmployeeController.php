<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Cache\Repository as Cache;
use App\Models\EmployeeServiceRecord;
use Illuminate\Http\Request;



class ApiEmployeeController extends Controller{


	protected $cache;
	protected $employee_sr;





	public function __construct(Cache $cache, EmployeeServiceRecord $employee_sr){

		$this->cache = $cache;
		$this->employee_sr = $employee_sr;

	}






	public function editServiceRecord(Request $request, $slug){

    	if($request->Ajax()){

    		$response_employee_sr = $this->cache->remember('api:employees:employee_serviceRecord:bySlug:'. $slug .'', 240, function() use ($slug){
        		return $this->employee_sr->where('slug', $slug)->get();
       		});

	    	return json_encode($response_employee_sr);
	    }

	    return abort(404);

    }




    
}
