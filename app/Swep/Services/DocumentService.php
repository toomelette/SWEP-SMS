<?php
 
namespace App\Swep\Services;

use File;
use App\Swep\Interfaces\DocumentInterface;
use App\Swep\BaseClasses\BaseService;



class DocumentService extends BaseService{



    protected $document_repo;



    public function __construct(DocumentInterface $document_repo){

        $this->document_repo = $document_repo;
        parent::__construct();

    }





    public function fetch($request){

        $documents = $this->document_repo->fetch($request);

        $request->flash();
        return view('dashboard.document.index')->with('documents', $documents);

    }







    public function store($request){

        $filename = $this->filename($request);

        $dir = $this->__dataType->date_parse($request->date, 'Y') .'/'. $request->folder_code;

        if(!is_null($request->file('doc_file'))){

            $request->file('doc_file')->storeAs($dir, $filename);

        }

        $document = $this->document_repo->store($request, $filename);

        $this->event->fire('document.store', $document);        
        return redirect()->back();

    }






    public function show($slug){

        $document = $this->document_repo->findBySlug($slug);
        return view('dashboard.document.show')->with('document', $document);

    }






    public function edit($slug){

        $document = $this->document_repo->findBySlug($slug);
        return view('dashboard.document.edit')->with('document', $document);

    }







    public function update($request, $slug){

        $document = $this->document_repo->findBySlug($slug);

        $filename = $this->filename($request);
        $old_dir = $document->year .'/'. $document->folder_code;
        $new_dir = $this->__dataType->date_parse($request->date, 'Y') .'/'. $request->folder_code;
        $old_file_dir = $document->year .'/'. $document->folder_code .'/'. $document->filename;


        if(!is_null($request->file('doc_file')) && $this->storage->disk('local')->exists($old_file_dir)){

            $request->file('doc_file')->storeAs($new_dir, $filename);

            $this->storage->disk('local')->delete($old_file_dir);

        }


        elseif($old_dir != $new_dir && $this->storage->disk('local')->exists($old_file_dir)){    

            $this->storage->disk('local')->move($old_dir .'/'. $document->filename, $new_dir .'/'. $document->filename);

        }


        $this->document_repo->update($request, $filename, $document);
        
        $this->event->fire('document.update', $document);
        return redirect()->route('dashboard.document.index');

    }







    public function destroy($slug){

        $document = $this->document_repo->findBySlug($slug);
        
        $file_dir = $document->year .'/'. $document->folder_code .'/'. $document->filename;

        if(!is_null($document->filename) && $this->storage->disk('local')->exists($file_dir)){ 

            $this->storage->disk('local')->delete($file_dir);

        }

        $this->document_repo->destroy($document);

        $this->event->fire('document.destroy', $document);
        return redirect()->back();

    }







    public function viewFile($slug){

        $document = $this->document_repo->findBySlug($slug);

        if(!empty($document)){

            $path = $this->__static->archive_dir() . $document->year .'/'. $document->folder_code .'/'. $document->filename;

            if (!File::exists($path)) {
                abort(404);
            }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);

            return $response;

        }

        return abort(404);
        

    }







    public function filename($request){

        if(!is_null($request->file('doc_file'))){

            return $request->subject .'-'. $this->str->random(8) .'.'. $request->file('doc_file')->getClientOriginalExtension();

        }

        return null;

    }







}