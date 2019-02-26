<?php
 
namespace App\Swep\Services;

use File;
use Hash;
use ZipArchive;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;

use App\Swep\Interfaces\UserInterface;
use App\Swep\Interfaces\DocumentInterface;
use App\Swep\BaseClasses\BaseService;



class DocumentService extends BaseService{



    protected $document_repo;
    protected $user_repo;



    public function __construct(UserInterface $user_repo, DocumentInterface $document_repo){

        $this->user_repo = $user_repo;
        $this->document_repo = $document_repo;
        parent::__construct();

    }





    public function fetch($request){

        $documents = $this->document_repo->fetch($request);

        $request->flash();
        return view('dashboard.document.index')->with('documents', $documents);

    }







    public function store($request){

        $filename = $request->reference_no .'-'. $request->subject .'-'. $this->str->random(8) .'.pdf';

        $dir = $this->__dataType->date_parse($request->date, 'Y') .'/'. $request->folder_code;

        $dir2 = $this->__dataType->date_parse($request->date, 'Y') .'/'. $request->folder_code2;

        if(!is_null($request->file('doc_file'))){

            $request->file('doc_file')->storeAs($dir, $filename);

            if (isset($request->folder_code2)) {

                $request->file('doc_file')->storeAs($dir2, $filename);

            }

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

        $filename = $this->filename($request, $document);

        $new_dir = $this->__dataType->date_parse($request->date, 'Y') .'/'. $request->folder_code;
        $old_dir = $document->year .'/'. $document->folder_code;
        $new_file_dir = $this->__dataType->date_parse($request->date, 'Y') .'/'. $request->folder_code .'/'. $filename;
        $old_file_dir = $document->year .'/'. $document->folder_code .'/'. $document->filename;

        $new_dir2 = $this->__dataType->date_parse($request->date, 'Y') .'/'. $request->folder_code2;
        $old_dir2 = $document->year .'/'. $document->folder_code2;
        $new_file_dir2 = $this->__dataType->date_parse($request->date, 'Y') .'/'. $request->folder_code2 .'/'. $filename;
        $old_file_dir2 = $document->year .'/'. $document->folder_code2 .'/'. $document->filename;


        // If theres new file upload
        if(!is_null($request->file('doc_file'))){


            if ($this->storage->disk('local')->exists($old_file_dir)) {
                $this->storage->disk('local')->delete($old_file_dir);
            }


            if (isset($request->folder_code2)) {
                if ($this->storage->disk('local')->exists($old_file_dir2)) {
                    $this->storage->disk('local')->delete($old_file_dir2); 
                }
            }
            

            $request->file('doc_file')->storeAs($new_dir, $filename);


            if (isset($request->folder_code2)) {
                $request->file('doc_file')->storeAs($new_dir2, $filename); 
            }


        }else{


            // If theres no file upload
            if($new_file_dir != $old_file_dir && $this->storage->disk('local')->exists($old_file_dir)){

                if($new_file_dir != $old_file_dir2 || $new_file_dir2 != $old_file_dir){

                    $this->storage->disk('local')->move($old_file_dir, $new_file_dir);

                }

            }




            if(isset($request->folder_code2) && $new_file_dir2 != $old_file_dir2){   

                if (isset($document->folder_code2) && $this->storage->disk('local')->exists($old_file_dir2)) {

                    if($new_file_dir != $old_file_dir2 || $new_file_dir2 != $old_file_dir){
                        $this->storage->disk('local')->move($old_file_dir2, $new_file_dir2);
                    }
                    
                }

                if (is_null($document->folder_code2) && $this->storage->disk('local')->exists($new_file_dir)) {
                    $this->storage->disk('local')->copy($new_file_dir, $new_file_dir2);
                }

            }



            if (is_null($request->folder_code2) && $this->storage->disk('local')->exists($old_file_dir2)) {
                $this->storage->disk('local')->delete($old_file_dir2);  
            }



        }


        $this->document_repo->update($request, $filename, $document);
        
        $this->event->fire('document.update', $document);
        return redirect()->route('dashboard.document.index');


    }







    public function destroy($slug){

        $document = $this->document_repo->findBySlug($slug);
        
        $file_dir = $document->year .'/'. $document->folder_code .'/'. $document->filename;
        $file_dir2 = $document->year .'/'. $document->folder_code2 .'/'. $document->filename;

        if(!is_null($document->filename)){

            if ($this->storage->disk('local')->exists($file_dir)) {
                $this->storage->disk('local')->delete($file_dir);
            }

            if ($this->storage->disk('local')->exists($file_dir2)) {
                $this->storage->disk('local')->delete($file_dir2);
            }

        }

        $this->document_repo->destroy($document);

        $this->event->fire('document.destroy', $document);
        return redirect()->back();

    }







    public function viewFile($slug){

        $document = $this->document_repo->findBySlug($slug);

        if(!empty($document->filename)){

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







    public function downloadDirect($request, $slug){

        $user = $this->user_repo->findBySlug($slug);  

        if ($request->username == $this->auth->user()->username && Hash::check($request->user_password, $this->auth->user()->password)) {

            $root_path = $this->__static->archive_dir() . $request->y .'/'. $request->fc;

            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($root_path), RecursiveIteratorIterator::LEAVES_ONLY);

			$zip = new ZipArchive();

			$zip->open($request->y .'-'. $request->fc .'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

			foreach ($files as $name => $file){

			    if (!$file->isDir()){

			        $file_path = $file->getRealPath();
			        $relative_path = substr($file_path, strlen($root_path));

			        $zip->addFile($file_path, $relative_path);
			    }

			}

			$zip->close();

            return response()->download($request->y .'-'. $request->fc .'.zip')->deleteFileAfterSend();

        }

        $this->session->flash('USER_RESET_PASSWORD_CONFIRMATION_FAIL', 'The credentials you provided does not match the current user!');
        return redirect()->back();

    }







    private function filename($request, $document){

        $filename = $document->filename;;
            
        if($request->subject != $document->subject || $request->reference_no != $document->reference_no){

            $filename = $request->reference_no .'-'. $request->subject .'-'. $this->str->random(8) .'.pdf';

        }

        return $filename;

    }







}