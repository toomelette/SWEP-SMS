<?php

namespace App\Http\Controllers;

use App\Swep\Services\DisbursementVoucherService;
use App\Http\Requests\DisbursementVoucherFormRequest;
use App\Http\Requests\DisbursementVoucherSetNoRequest;
use App\Http\Requests\DisbursementVoucherFilterRequest;



class DisbursementVoucherController extends Controller{


    protected $disbursement_voucher;


    public function __construct(DisbursementVoucherService $disbursement_voucher){

        $this->disbursement_voucher = $disbursement_voucher;

    }


    
    public function index(DisbursementVoucherFilterRequest $request){

        return $this->disbursement_voucher->fetchAll($request);

    }



    public function userIndex(DisbursementVoucherFilterRequest $request){

        return $this->disbursement_voucher->fetchByUser($request);

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

        return $this->disbursement_voucher->edit($slug);
        
    }



    public function update(DisbursementVoucherFormRequest $request, $slug){

        return $this->disbursement_voucher->update($request, $slug);
        
    }


    
    public function destroy($slug){

        return $this->disbursement_voucher->destroy($slug);
        
    }



    public function print($slug, $type){

        return $this->disbursement_voucher->print($slug, $type);
        
    }

        

    public function setNo(DisbursementVoucherSetNoRequest $request, $slug){

        return $this->disbursement_voucher->setNo($request, $slug);
        
    }



    public function confirmCheck($slug){

        return $this->disbursement_voucher->confirmCheck($slug);
        
    }

    
}
