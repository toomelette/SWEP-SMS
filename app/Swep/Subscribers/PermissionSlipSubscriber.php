<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class PermissionSlipSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }





    public function subscribe($events){

        $events->listen('ps.store', 'App\Swep\Subscribers\PermissionSlipSubscriber@onStore');
        $events->listen('ps.update', 'App\Swep\Subscribers\PermissionSlipSubscriber@onUpdate');
        $events->listen('ps.destroy', 'App\Swep\Subscribers\PermissionSlipSubscriber@onDestroy');

    }





    public function onStore(){

        $this->__cache->deletePattern('swep_cache:permission_slips:all:*');

        $this->session->flash('PS_CREATE_SUCCESS', 'The PS has been successfully created!');

    }





    public function onUpdate($permission_slip){

        $this->__cache->deletePattern('swep_cache:permission_slips:all:*');
        $this->__cache->deletePattern('swep_cache:permission_slips:bySlug:'. $permission_slip->slug .'');

        $this->session->flash('PS_UPDATE_SUCCESS', 'The PS has been successfully updated!');
        $this->session->flash('PS_UPDATE_SUCCESS_SLUG', $permission_slip->slug);

    }





    public function onDestroy($permission_slip){

        $this->__cache->deletePattern('swep_cache:permission_slips:all:*');
        $this->__cache->deletePattern('swep_cache:permission_slips:bySlug:'. $permission_slip->slug .'');

        $this->session->flash('PS_DELETE_SUCCESS', 'The PS has been successfully deleted!');
        
    }





}