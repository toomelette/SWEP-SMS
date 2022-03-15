<?php


namespace App\Http\Controllers;


use App\Models\PapParent;
use http\Env\Request;
use Yajra\DataTables\DataTables;

class PPMPController extends Controller
{
    public function index(){

        return view('dashboard.ppmp.index');
    }


}