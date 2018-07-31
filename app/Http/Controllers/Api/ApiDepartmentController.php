<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Swep\Interfaces\DepartmentInterface;



class ApiDepartmentController extends Controller{


	protected $department_repo;





	public function __construct(DepartmentInterface $department_repo){

		$this->department_repo = $department_repo;

	}







    public function textboxDepartmentByDepartmentId(Request $request, $dept_id){

    	if($request->Ajax()){

    		$response_department_name = $this->department_repo->apiGetByDepartmentId($dept_id);

	    	return json_encode($response_department_name);

	    }

	    return abort(404);
	    
    }








    
}
