<?php
 
namespace App\Swep\Services;


use App\Swep\Interfaces\DocumentFolderInterface;
use App\Swep\BaseClasses\BaseService;



class DocumentFolderService extends BaseService{



    protected $document_folder_repo;



    public function __construct(DocumentFolderInterface $document_folder_repo){

        $this->document_folder_repo = $document_folder_repo;
        parent::__construct();

    }





    public function fetchAll($request){

        

    }






    public function store($request){



    }







}