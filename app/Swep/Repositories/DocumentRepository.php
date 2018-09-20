<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\DocumentInterface;


use App\Models\Document;


class DocumentRepository extends BaseRepository implements DocumentInterface {
	



    protected $document;




	public function __construct(Document $document){

        $this->document = $document;
        parent::__construct();

    }






    public function fetchAll($request){

        $key = str_slug($request->fullUrl(), '_');

        $documents = $this->cache->remember('documents:all:' . $key, 240, function() use ($request){

            $df = $this->__dataType->date_parse($request->df);
            $dt = $this->__dataType->date_parse($request->dt);

            $document = $this->document->newQuery();
            
            $parsed_date = $this->__dataType->date_parse($request->d);

            if(isset($request->q)){
                $this->search($document, $request->q);
            }

            if(isset($request->fc)){
                $document->whereFolderCode($request->fc);
            }

            if(isset($request->dct)){
                $document->whereType($request->dct);
            }

            if(isset($request->df) || isset($request->dt)){
                $document->whereBetween('date', [$df, $dt]);
            }

            return $this->populate($document);

        });

        return $documents;

    }







    public function fetchByFolderCode($folder_code){

        $documents = $this->cache->remember('documents:byFolderCode:' . $folder_code, 240, function() use ($folder_code){

            $document = $this->document->newQuery();

            return $document->select('subject', 'slug', 'updated_at')
                            ->whereFolderCode($folder_code)
                            ->sortable()
                            ->orderBy('updated_at', 'desc')
                            ->paginate(10);

        });

        return $documents;

    }







    public function store($request, $filename){

        $document = new document;
        $document->slug = $this->str->random(32);
        $document->document_id = $this->getDocumentIdInc();
        $document->filename = $filename;
        $document->reference_no = $request->reference_no;
        $document->date = $this->__dataType->date_parse($request->date);
        $document->person_to = $request->person_to;
        $document->person_from = $request->person_from;
        $document->type = $request->type;
        $document->subject = $request->subject;
        $document->folder_code = $request->folder_code;
        $document->remarks = $request->remarks;
        $document->year = $this->__dataType->date_parse($request->date, 'Y');
        $document->created_at = $this->carbon->now();
        $document->updated_at = $this->carbon->now();
        $document->ip_created = request()->ip();
        $document->ip_updated = request()->ip();
        $document->user_created = $this->auth->user()->user_id;
        $document->user_updated = $this->auth->user()->user_id;
        $document->save();

        return $document;

    }






    public function update($request, $filename, $document){

        if(isset($filename)){
            $document->filename = $filename;      
        }

        $document->reference_no = $request->reference_no;
        $document->date = $this->__dataType->date_parse($request->date);
        $document->person_to = $request->person_to;
        $document->person_from = $request->person_from;
        $document->type = $request->type;
        $document->subject = $request->subject;
        $document->folder_code = $request->folder_code;
        $document->remarks = $request->remarks;
        $document->year = $this->__dataType->date_parse($request->date, 'Y');
        $document->updated_at = $this->carbon->now();
        $document->ip_updated = request()->ip();
        $document->user_updated = $this->auth->user()->user_id;
        $document->save();

        return $document;
        
    }






    public function destroy($document){

        $document->delete();
        return $document;
        
    }






    public function findBySlug($slug){

        $document = $this->cache->remember('documents:bySlug:' . $slug, 240, function() use ($slug){
            return $this->document->where('slug', $slug)->first();
        });
        
        if(empty($document)){
            abort(404);
        }
        
        return $document;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('reference_no', 'LIKE', '%'. $key .'%')
                      ->orwhere('person_to', 'LIKE', '%'. $key .'%')
                      ->orwhere('person_from', 'LIKE', '%'. $key .'%')
                      ->orwhere('subject', 'LIKE', '%'. $key .'%')
                      ->orwhere('remarks', 'LIKE', '%'. $key .'%');
        });

    }






    public function populate($model){

        return $model->select('filename', 'reference_no', 'date', 'person_to', 'person_from', 'subject', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }






    public function getDocumentIdInc(){

        $id = 'DOC10000001';

        $document = $this->document->select('document_id')->orderBy('document_id', 'desc')->first();

        if($document != null){
            
            if($document->document_id != null){
                $num = str_replace('DOC', '', $document->document_id) + 1;
                $id = 'DOC' . $num;
            }
        
        }
        
        return $id;
        
    }








}