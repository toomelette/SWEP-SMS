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

        $this->__cache->deletePattern('swep_cache:document_folders:fetch:*');
        $this->__cache->deletePattern('swep_cache:document_folders:getAll');

        $this->session->flash('DOC_FOLDER_CREATE_SUCCESS', 'The Document Folder has been successfully created!');

    }





    public function onUpdate($doc_folder){

        $this->__cache->deletePattern('swep_cache:document_folders:fetch:*');
        $this->__cache->deletePattern('swep_cache:document_folders:getAll');
        $this->__cache->deletePattern('swep_cache:document_folders:findBySlug:'. $doc_folder->slug .'');

        $this->session->flash('DOC_FOLDER_UPDATE_SUCCESS', 'The Document Folder has been successfully updated!');
        $this->session->flash('DOC_FOLDER_UPDATE_SUCCESS_SLUG', $doc_folder->slug);

    }





    public function onDestroy($doc_folder){

        $this->__cache->deletePattern('swep_cache:document_folders:fetch:*');
        $this->__cache->deletePattern('swep_cache:document_folders:getAll');
        $this->__cache->deletePattern('swep_cache:document_folders:findBySlug:'. $doc_folder->slug .'');

        $this->session->flash('DOC_FOLDER_DELETE_SUCCESS', 'The Document Folder has been successfully deleted!');
        
    }






}