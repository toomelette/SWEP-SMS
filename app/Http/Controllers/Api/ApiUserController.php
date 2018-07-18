<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Cache\Repository as Cache;
use Illuminate\Http\Request;
use App\Models\Employee;




class ApiUserController extends Controller{


	protected $cache;
	protected $employee;





	public function __construct(Cache $cache, Employee $employee){

		$this->cache = $cache;
		$this->employee = $employee;

	}






	public function responseFromEmployee(Request $request, $key){

    	if($request->Ajax()){

    		$response_employee = $this->cache->remember('api:employees:bySlug:'. $key .'', 240, function() use ($key){
        		return $this->employee->where('slug', $key)->get();
       		});

	    	return json_encode($response_employee);
	    }

	    return abort(404);

    }




    
}
