<?php
 
namespace App\Swep\Services;


use App\Swep\Interfaces\DocumentInterface;
use App\Swep\BaseClasses\BaseService;



class DocumentService extends BaseService{



    protected $document_repo;



    public function __construct(DocumentInterface $document_repo){

        $this->document_repo = $document_repo;
        parent::__construct();

    }





    public function fetchAll($request){

        // $department_units = $this->department_unit_repo->fetchAll($request);

        // $request->flash();
        // return view('dashboard.department_unit.index')->with('department_units', $department_units);

    }






    public function store($request){

        // $department_unit = $this->department_unit_repo->store($request);

        // $this->event->fire('department_unit.store');        
        // return redirect()->back();

    }






    public function edit($slug){

        // $department_unit = $this->department_unit_repo->findBySlug($slug);
        // return view('dashboard.department_unit.edit')->with('department_unit', $department_unit);

    }






    public function update($request, $slug){

        // $department_unit = $this->department_unit_repo->update($request, $slug);
        
        // $this->event->fire('department_unit.update', $department_unit);
        // return redirect()->route('dashboard.department_unit.index');

    }






    public function destroy($slug){

        // $department_unit = $this->department_unit_repo->destroy($slug);
        
        // $this->event->fire('department_unit.destroy', $department_unit);
        // return redirect()->route('dashboard.department_unit.index');

    }






}