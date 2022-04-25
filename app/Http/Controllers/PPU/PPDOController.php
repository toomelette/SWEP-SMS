<?php


namespace App\Http\Controllers\PPU;


use App\Http\Controllers\Controller;
use App\Http\Requests\PPDO\PPDOFormRequest;
use Illuminate\Http\Request;

class PPDOController extends Controller
{

    public function index(Request $requests){
        if($requests->has('fiscal_year')){
            return view('ppu.ppdo.index');
        }
        return view('ppu.ppdo.pre_index');
    }

    public function store(PPDOFormRequest $request){
        return $request;
    }
}