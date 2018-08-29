<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class DocumentFolderSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }





    public function subscribe($events){

        $events->listen('document_folder.store', 'App\Swep\Subscribers\DocumentFolderSubscriber@onStore');
        $events->listen('document_folder.update', 'App\Swep\Subscribers\DocumentFolderSubscriber@onUpdate');
        $events->listen('document_folder.destroy', 'App\Swep\Subscribers\DocumentFolderSubscriber@onDestroy');

    }





    public function onStore(){

        $this->cacheHelper->deletePattern('swep_cache:document_folders:all:*');

        $this->session->flash('DOCUMENT_FOLDER_CREATE_SUCCESS', 'The Document Folder has been successfully created!');

    }





    public function onUpdate($document_folder){

        $this->cacheHelper->deletePattern('swep_cache:document_folder:all:*');
        $this->cacheHelper->deletePattern('swep_cache:document_folder:bySlug:'. $document_folder->slug .'');

        $this->session->flash('DOCUMENT_FOLDER_UPDATE_SUCCESS', 'The Document Folder has been successfully updated!');
        $this->session->flash('DOCUMENT_FOLDER_UPDATE_SUCCESS_SLUG', $document_folder->slug);

    }





    public function onDestroy($document_folder){

        $this->cacheHelper->deletePattern('swep_cache:document_folder:all:*');
        $this->cacheHelper->deletePattern('swep_cache:document_folder:bySlug:'. $document_folder->slug .'');

        $this->session->flash('DOCUMENT_FOLDER_DELETE_SUCCESS', 'The Document Folder has been successfully deleted!');
        
    }





}