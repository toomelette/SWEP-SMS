<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class DocumentSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }





    public function subscribe($events){

        $events->listen('document.store', 'App\Swep\Subscribers\DocumentSubscriber@onStore');
        $events->listen('document.update', 'App\Swep\Subscribers\DocumentSubscriber@onUpdate');
        $events->listen('document.destroy', 'App\Swep\Subscribers\DocumentSubscriber@onDestroy');

    }





    public function onStore(){

        $this->cacheHelper->deletePattern('swep_cache:documents:all:*');

        $this->session->flash('DOCUMENT_CREATE_SUCCESS', 'The Document has been successfully created!');

    }





    public function onUpdate($document){

        $this->cacheHelper->deletePattern('swep_cache:documents:all:*');
        $this->cacheHelper->deletePattern('swep_cache:documents:bySlug:'. $document->slug .'');

        $this->session->flash('DOCUMENT_UPDATE_SUCCESS', 'The Document has been successfully updated!');
        $this->session->flash('DOCUMENT_UPDATE_SUCCESS_SLUG', $document->slug);

    }





    public function onDestroy($document){

        $this->cacheHelper->deletePattern('swep_cache:documents:all:*');
        $this->cacheHelper->deletePattern('swep_cache:documents:bySlug:'. $document->slug .'');

        $this->session->flash('DOCUMENT_DELETE_SUCCESS', 'The Document has been successfully deleted!');
        
    }





}