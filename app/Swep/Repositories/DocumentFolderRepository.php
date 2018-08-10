<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\DocumentFolderInterface;


use App\Models\DocumentFolder;


class DocumentFolderRepository extends BaseRepository implements DocumentFolderInterface {
	



    protected $doc_folder;




	public function __construct(DocumentFolder $doc_folder){

        $this->doc_folder = $doc_folder;
        parent::__construct();

    }





    public function globalFetchAll(){

        $doc_folders = $this->cache->remember('document_folders:global:all', 240, function(){
            return $this->doc_folder->select('folder_code')->get();
        });
        
        return $doc_folders;

    }






}