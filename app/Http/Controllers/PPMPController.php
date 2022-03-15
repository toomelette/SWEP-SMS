<?php


namespace App\Http\Controllers;


class PPMPController extends Controller
{
    public function index(){
        return view('dashboard.ppmp.index');
    }
}