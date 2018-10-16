<?php

namespace App\Http\Controllers;

use App\Swep\Services\ApplicantService;
use App\Http\Requests\ApplicantFormRequest;
use App\Http\Requests\ApplicantFilterRequest;




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

		return $this->applicant->fetchAll($request);

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


    


    
}
