<?php

namespace App\Http\Controllers;

use App\Swep\Services\DocumentService;
use App\Http\Requests\Document\DocumentFormRequest;
use App\Http\Requests\Document\DocumentFilterRequest;
use App\Http\Requests\Document\DocumentDownloadRequest;
use App\Http\Requests\Document\DocumentDisseminationRequest;
use Illuminate\Http\Request;

class DocumentController extends Controller{



	protected $document;



    public function __construct(DocumentService $document){

        $this->document = $document;

    }



    
    public function index(DocumentFilterRequest $request){

        return $this->document->fetch($request);
    
    }

    


    public function create(){

        return view('dashboard.document.create');

    }

    


    public function store(DocumentFormRequest $request){

        return $this->document->store($request);
        
    }




    public function show($slug){

        return $this->document->show($slug);
        
    }




    public function edit($slug){

        return $this->document->edit($slug);
        
    }




    public function update(DocumentFormRequest $request, $slug){

        return $this->document->update($request, $slug);

    }

    


    public function destroy($slug){

       return $this->document->destroy($slug); 

    }




    public function viewFile($slug){

       return $this->document->viewFile($slug); 

    }




    public function download(){

        return view('dashboard.document.download');

    }




    public function downloadDirect(DocumentDownloadRequest $request, $slug){

       return $this->document->downloadDirect($request, $slug); 

    }




    public function dissemination(Request $request, $slug){

       return $this->document->dissemination($request,$slug); 

    }




    public function disseminationPost(DocumentDisseminationRequest $request, $slug){

       return $this->document->disseminationPost($request, $slug); 
       
    }

    public function print($slug)
    {
        return $this->document->print($slug); 
    }

    public function report(){
        return view('dashboard.document.report');
    }
    
    public function report_generate(Request $request){

        return $this->document->report_generate($request);
    }

    public function rename_all(){
        //return 1;
        return $this->document->rename_all();
    }
}
