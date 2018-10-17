<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class PlantillaSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }





    public function subscribe($events){

        $events->listen('plantilla.store', 'App\Swep\Subscribers\PlantillaSubscriber@onStore');
        $events->listen('plantilla.update', 'App\Swep\Subscribers\PlantillaSubscriber@onUpdate');
        $events->listen('plantilla.destroy', 'App\Swep\Subscribers\PlantillaSubscriber@onDestroy');

    }





    public function onStore(){

        $this->__cache->deletePattern('swep_cache:plantillas:all:*');
        $this->__cache->deletePattern('swep_cache:plantillas:global:all');

        $this->session->flash('PLANTILLA_CREATE_SUCCESS', 'The Plantilla has been successfully created!');

    }





    public function onUpdate($plantilla){

        $this->__cache->deletePattern('swep_cache:plantillas:all:*');
        $this->__cache->deletePattern('swep_cache:plantillas:bySlug:'. $plantilla->slug .'');
        $this->__cache->deletePattern('swep_cache:plantillas:global:all');

        $this->session->flash('PLANTILLA_UPDATE_SUCCESS', 'The Plantilla has been successfully updated!');
        $this->session->flash('PLANTILLA_UPDATE_SUCCESS_SLUG', $plantilla->slug);

    }





    public function onDestroy($plantilla){

        $this->__cache->deletePattern('swep_cache:plantillas:all:*');
        $this->__cache->deletePattern('swep_cache:plantillas:bySlug:'. $plantilla->slug .'');
        $this->__cache->deletePattern('swep_cache:plantillas:global:all');

        $this->session->flash('PLANTILLA_DELETE_SUCCESS', 'The Plantilla has been successfully deleted!');
        
    }





}