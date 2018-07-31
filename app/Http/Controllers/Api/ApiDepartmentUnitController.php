<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Swep\Interfaces\DepartmentUnitInterface;



class ApiDepartmentUnitController extends Controller{



    protected $department_unit_repo;






	public function __construct(DepartmentUnitInterface $department_unit_repo){

        $this->department_unit_repo = $department_unit_repo;

	}








    public function selectDepartmentUnitByDepartmentName(Request $request, $dept_name){

    	if($request->Ajax()){
    		$response_department_units = $this->department_unit_repo->apiGetByDepartmentName($dept_name);
	    	return json_encode($response_department_units);
	    }

	    return abort(404);
	    
    }








    public function selectDepartmentUnitByDepartmentId(Request $request, $dept_id){

        if($request->Ajax()){
            $response_department_units = $this->department_unit_repo->apiGetByDepartmentId($dept_id);
            return json_encode($response_department_units);
        }

        return abort(404);
        
    }







    
}
