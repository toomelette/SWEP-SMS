<?php

namespace App\Swep\ViewComposers;


use View;
use App\Swep\Interfaces\DocumentFolderInterface;


class DocumentFolderComposer{
   


	protected $doc_folder_repo;



	public function __construct(DocumentFolderInterface $doc_folder_repo){

		$this->doc_folder_repo = $doc_folder_repo;

	}



    public function compose($view){

        $doc_folders = $this->doc_folder_repo->getAll();
        
    	$view->with('global_document_folders_all', $doc_folders);
    	
    }




}