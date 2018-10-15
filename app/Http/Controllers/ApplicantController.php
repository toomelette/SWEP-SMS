<?php

namespace App\Http\Controllers;

use App\Swep\Services\ApplicantService;
use App\Http\Requests\ApplicantFormRequest;




class ApplicantController extends Controller{



	protected $applicant;



    public function __construct(ApplicantService $applicant){

        $this->applicant = $applicant;

    }




	public function create(){

        return view('dashboard.applicant.create');

    }




	public function store(ApplicantFormRequest $request){

		return $this->applicant->store($request);

    }




    


    
}
