<?php

namespace App\Http\Controllers;


use App\Swep\Services\HomeService;



class HomeController extends Controller{
    



	protected $home;




    public function __construct(HomeService $home){

        $this->home = $home;

    }





    public function index(){

    	return $this->home->view();

    }
    





}
