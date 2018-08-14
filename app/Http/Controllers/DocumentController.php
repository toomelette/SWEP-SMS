<?php

namespace App\Http\Controllers;

use App\Swep\Services\DocumentService;
use App\Http\Requests\DocumentFormRequest;
use App\Http\Requests\DocumentFilterRequest;


class DocumentController extends Controller{



	protected $document;



    public function __construct(DocumentService $document){

        $this->document = $document;

    }



    
    public function index(DocumentFilterRequest $request){

        return $this->document->fetchAll($request);
    
    }

    


    public function create(){

        return view('dashboard.document.create');

    }

    


    public function store(DocumentFormRequest $request){

        return $this->document->store($request);
        
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




    
}
