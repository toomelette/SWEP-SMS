<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DisbursementVoucherFormRequest;
use App\Swep\Services\DisbursementVoucherService;



class DisbursementVoucherController extends Controller{


    protected $disbursement_voucher;



    public function __construct(DisbursementVoucherService $disbursement_voucher){

        $this->disbursement_voucher = $disbursement_voucher;

    }


    
    public function index(){

        
    }



    public function create(){

        return view('dashboard.disbursement_voucher.create');
        
    }


   
    public function store(DisbursementVoucherFormRequest $request){

        return $this->disbursement_voucher->store($request);
        
    }


    
    public function show($slug){

        return $this->disbursement_voucher->show($slug);
        
    }


    
    public function edit($slug){


        
    }



    public function update(Request $request, $slug){


        
    }


    
    public function destroy($slug){


        
    }



    public function print($slug){

        return $this->disbursement_voucher->print($slug);
        
    }

    
    
}
