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






    // public function fetchAll($request){

    //     $key = str_slug($request->fullUrl(), '_');

    //     $documents = $this->cache->remember('documents:all:' . $key, 240, function() use ($request){

    //         $document = $this->document->newQuery();
            
    //         if(isset($request->q)){
    //             $this->search($document, $request->q);
    //         }

    //         return $this->populate($document);

    //     });

    //     return $documents;

    // }






    // public function store($request){

    //     $document = new document;
    //     $document->slug = $this->str->random(16);
    //     $document->document_id = $this->getdocumentIdInc();
    //     $document->name = $request->name;
    //     $document->created_at = $this->carbon->now();
    //     $document->updated_at = $this->carbon->now();
    //     $document->ip_created = request()->ip();
    //     $document->ip_updated = request()->ip();
    //     $document->user_created = $this->auth->user()->user_id;
    //     $document->user_updated = $this->auth->user()->user_id;
    //     $document->save();

    //     return $document;

    // }






    // public function update($request, $slug){

    //     $document = $this->findBySlug($slug);
    //     $document->name = $request->name;
    //     $document->updated_at = $this->carbon->now();
    //     $document->ip_updated = request()->ip();
    //     $document->user_updated = $this->auth->user()->user_id;
    //     $document->save();

    //     return $document;

    // }






    // public function destroy($slug){

    //     $document = $this->findBySlug($slug);
    //     $document->delete();

    //     return $document;

    // }






    // public function findBySlug($slug){

    //     $document = $this->cache->remember('documents:bySlug:' . $slug, 240, function() use ($slug){
    //         return $this->document->where('slug', $slug)->first();
    //     });
        
    //     return $document;

    // }






    // public function search($model, $key){

    //     return $model->where(function ($model) use ($key) {
    //             $model->where('name', 'LIKE', '%'. $key .'%');
    //     });

    // }






    // public function populate($model){

    //     return $model->select('name', 'slug')
    //                  ->sortable()
    //                  ->orderBy('updated_at', 'desc')
    //                  ->paginate(10);

    // }






    // public function getdocumentIdInc(){

    //     $id = 'D1001';

    //     $document = $this->document->select('document_id')->orderBy('document_id', 'desc')->first();

    //     if($document != null){
            
    //         if($document->document_id != null){
    //             $num = str_replace('D', '', $document->document_id) + 1;
    //             $id = 'D' . $num;
    //         }
        
    //     }
        
    //     return $id;
        
    // }






    // public function globalFetchAll(){

    //     $documents = $this->cache->remember('documents:global:all', 240, function(){
    //         return $this->document->select('name', 'document_id')->get();
    //     });
        
    //     return $documents;

    // }






    // public function apiGetBydocumentId($dept_id){

    //     $document_name = $this->cache->remember('api:documents:bydocumentId:'. $dept_id .'', 240, function() use ($dept_id){

    //         return $this->document->select('name')
    //                                 ->where('document_id', $dept_id)
    //                                 ->get();
                                    
    //     });
        
    //     return $document_name;

    // }







}