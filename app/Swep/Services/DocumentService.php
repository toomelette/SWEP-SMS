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

        $document = $this->document_repo->findBySlug($slug);
        return view('dashboard.document.edit')->with('document', $document);

    }







    public function update($request, $slug){

        $document = $this->document_repo->findBySlug($slug);

        $filename = $this->storeFile($request);

        $this->removeFile($request, $document);

        $this->moveFile($request, $document);

        $this->document_repo->update($request, $filename, $document);
        
        $this->event->fire('document.update', $document);
        return redirect()->route('dashboard.document.index');

    }







    public function destroy($slug){

        // $department_unit = $this->department_unit_repo->destroy($slug);
        
        // $this->event->fire('department_unit.destroy', $department_unit);
        // return redirect()->route('dashboard.department_unit.index');

    }







    public function storeFile($request){

        if(!is_null($request->file('doc_file'))){

            $filename = $this->str->random(32) .'.'. $request->file('doc_file')->getClientOriginalExtension();

            $folder = $this->dataTypeHelper->date_parse($request->date, 'Y') .'/'. $request->folder_code;

            $request->file('doc_file')->storeAs($folder, $filename);

            return $filename;

        }

        return null;

    }







    public function removeFile($request, $document){

        $file_dir = $document->year .'/'. $document->folder_code .'/'. $document->filename;

        if(!is_null($request->file('doc_file')) && $this->storage->disk('local')->exists($file_dir)){       

            $this->storage->disk('local')->delete($file_dir);

        }

    }







    public function moveFile($request, $document){

        $existing_dir = $document->year .'/'. $document->folder_code;

        $request_dir = $this->dataTypeHelper->date_parse($request->date, 'Y') .'/'. $request->folder_code;

        if($existing_dir != $request_dir){

            $this->storage->disk('local')->move($existing_dir .'/'. $document->filename, $request_dir .'/'. $document->filename);

        }

    }








}