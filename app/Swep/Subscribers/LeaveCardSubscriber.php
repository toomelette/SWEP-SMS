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
        
        $this->__cache->deletePattern('swep_cache:leave_cards:all:*');

        $this->session->flash('LC_CREATE_SUCCESS', 'Your Leave Card has been successfully Created!');
        $this->session->flash('LC_CREATE_SUCCESS_SLUG', $leave_card->slug);

    }





    public function onUpdate($leave_card){

        $this->__cache->deletePattern('swep_cache:leave_cards:all:*');
        $this->__cache->deletePattern('swep_cache:leave_cards:bySlug:'. $leave_card->slug .'');

        $this->session->flash('LC_UPDATE_SUCCESS', 'Your Leave Card has been successfully Updated!');
        $this->session->flash('LC_UPDATE_SUCCESS_SLUG', $leave_card->slug);

    }





    public function onDestroy($leave_card){

        $this->__cache->deletePattern('swep_cache:leave_cards:all:*');
        $this->__cache->deletePattern('swep_cache:leave_cards:bySlug:'. $leave_card->slug .'');

        $this->session->flash('LC_DELETE_SUCCESS', 'Your Leave Card has been successfully Deleted!');

    }






}