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

        $documents = $this->document_repo->fetchAll($request);

        $request->flash();
        return view('dashboard.document.index')->with('documents', $documents);

    }






    public function store($request){

        $filename = $this->storeFile($request);

        $document = $this->document_repo->store($request, $filename);

        $this->event->fire('document.store');        
        return redirect()->back();

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






    public function storeFile($request){

        $filename = $this->str->random(32) .'.'. $request->file('doc_file')->getClientOriginalExtension();

        $year = $this->dataTypeHelper->date_parse($request->date, 'Y');

        $request->file('doc_file')->move($this->staticHelper->archive_dir() .'/'. $year .'/'. $request->folder_code , $filename);

        return $filename;

    }







}