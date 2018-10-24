<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Swep\Interfaces\ProjectCodeInterface;




class ApiProjectCodeController extends Controller{




	protected $project_code_repo;





	public function __construct(ProjectCodeInterface $project_code_repo){

        $this->project_code_repo = $project_code_repo;

	}







	public function selectProjectCodeByDepartmentName(Request $request, $dept_name){

    	if($request->Ajax()){
    		$response_project_codes = $this->project_code_repo->getByDepartmentName($dept_name);
	    	return json_encode($response_project_codes);
	    }

	    return abort(404);
	    
    }







   
}
