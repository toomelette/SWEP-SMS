<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class SignatorySubscriber extends BaseSubscriber{


    

    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('signatory.store', 'App\Swep\Subscribers\SignatorySubscriber@onStore');
        $events->listen('signatory.update', 'App\Swep\Subscribers\SignatorySubscriber@onUpdate');
        $events->listen('signatory.destroy', 'App\Swep\Subscribers\SignatorySubscriber@onDestroy');

    }





    public function onStore(){

        $this->cacheHelper->deletePattern('swep_cache:signatories:all:*');
        $this->cacheHelper->deletePattern('swep_cache:signatories:global:all');

        $this->session->flash('SIGNATORY_CREATE_SUCCESS', 'The Signatory has been successfully created!');

    }





    public function onUpdate($signatory){

        $this->cacheHelper->deletePattern('swep_cache:signatories:all:*');
        $this->cacheHelper->deletePattern('swep_cache:signatories:global:all');
        $this->cacheHelper->deletePattern('swep_cache:signatories:bySlug:'. $signatory->slug .'');

        $this->session->flash('SIGNATORY_UPDATE_SUCCESS', 'The Signatory has been successfully updated!');
        $this->session->flash('SIGNATORY_UPDATE_SUCCESS_SLUG', $signatory->slug);

    }





    public function onDestroy($signatory){

        $this->cacheHelper->deletePattern('swep_cache:signatories:all:*');
        $this->cacheHelper->deletePattern('swep_cache:signatories:global:all');
        $this->cacheHelper->deletePattern('swep_cache:signatories:bySlug:'. $signatory->slug .'');

        $this->session->flash('SIGNATORY_DELETE_SUCCESS', 'The Signatory has been successfully deleted!');

    }





}