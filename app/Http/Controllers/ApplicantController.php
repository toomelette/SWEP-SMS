<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;




class ApplicantController extends Controller{




	public function create(){

        return view('dashboard.applicant.create');

    }


    
}
