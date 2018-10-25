<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class LeaveCardSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('leave_card.store', 'App\Swep\Subscribers\LeaveCardSubscriber@onStore');
        $events->listen('leave_card.update', 'App\Swep\Subscribers\LeaveCardSubscriber@onUpdate');
        $events->listen('leave_card.destroy', 'App\Swep\Subscribers\LeaveCardSubscriber@onDestroy');

    }




    public function onStore($leave_card){
        
        $this->__cache->deletePattern('swep_cache:leave_cards:fetch:*');

        $this->session->flash('LC_CREATE_SUCCESS', 'Your Record has been successfully Created!');
        $this->session->flash('LC_CREATE_SUCCESS_SLUG', $leave_card->slug);

    }





    public function onUpdate($leave_card){

        $this->__cache->deletePattern('swep_cache:leave_cards:fetch:*');
        $this->__cache->deletePattern('swep_cache:leave_cards:findBySlug:'. $leave_card->slug .'');

        $this->session->flash('LC_UPDATE_SUCCESS', 'Your Record has been successfully Updated!');
        $this->session->flash('LC_UPDATE_SUCCESS_SLUG', $leave_card->slug);

    }





    public function onDestroy($leave_card){

        $this->__cache->deletePattern('swep_cache:leave_cards:fetch:*');
        $this->__cache->deletePattern('swep_cache:leave_cards:findBySlug:'. $leave_card->slug .'');

        $this->session->flash('LC_DELETE_SUCCESS', 'Your Record has been successfully Deleted!');

    }






}