<?php

namespace App\Http\Controllers;

use App\Swep\Services\ApplicantService;
use App\Http\Requests\Applicant\ApplicantFormRequest;
use App\Http\Requests\Applicant\ApplicantFilterRequest;
use App\Http\Requests\Applicant\ApplicantReportRequest;




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




	public function index(ApplicantFilterRequest $request){

		return $this->applicant->fetch($request);

    }




	public function show($slug){

		return $this->applicant->show($slug);

    }




	public function edit($slug){

		return $this->applicant->edit($slug);

    }




	public function update(ApplicantFormRequest $request, $slug){

		return $this->applicant->update($request, $slug);

    }




	public function destroy($slug){

		return $this->applicant->destroy($slug);

    }




	public function report(){

		return view('dashboard.applicant.report');

    }




	public function reportGenerate(ApplicantReportRequest $request){

		return $this->applicant->reportGenerate($request);

    }




	public function addToShortList($slug){

		return $this->applicant->addToShortList($slug);

    }




	public function removeToShortList($slug){

		return $this->applicant->removeToShortList($slug);

    }


    


    
}
