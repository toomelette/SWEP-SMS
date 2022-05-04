<?php
 
namespace App\Swep\Services;

use App\Swep\Interfaces\SignatoryInterface;
use App\Swep\BaseClasses\BaseService;



class SignatoryService extends BaseService{


    protected $signatory_repo;



    public function __construct(SignatoryInterface $signatory_repo){

        $this->signatory_repo = $signatory_repo;
        parent::__construct();

    }





    public function fetch($request){

        $signatories = $this->signatory_repo->fetch($request);

        $request->flash();
        return view('dashboard.signatory.index')->with('signatories', $signatories);

    }






    public function store($request){

        $signatory = $this->signatory_repo->store($request);

//        $this->event->dispatch('signatory.store');
        return redirect()->back();

    }






    public function edit($slug){

        $signatory = $this->signatory_repo->findBySlug($slug);
        return view('dashboard.signatory.edit')->with('signatory', $signatory);

    }






    public function update($request, $slug){

        $signatory = $this->signatory_repo->update($request, $slug);

//        $this->event->dispatch('signatory.update', $signatory);
        return redirect()->route('dashboard.signatory.index');

    }






    public function destroy($slug){

        $signatory = $this->signatory_repo->destroy($slug);

//        $this->event->dispatch('signatory.destroy', $signatory);
        return redirect()->back();

    }






}