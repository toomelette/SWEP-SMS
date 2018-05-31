<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class LeaveApplicationSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('la.store', 'App\Swep\Subscribers\LeaveApplicationSubscriber@onStore');
        $events->listen('la.update', 'App\Swep\Subscribers\LeaveApplicationSubscriber@onUpdate');
        $events->listen('la.destroy', 'App\Swep\Subscribers\LeaveApplicationSubscriber@onDestroy');

    }




    public function onStore($leave_application){
        
        $this->cacheHelper->deletePattern('swep_cache:leave_applications:all:*');
        $this->cacheHelper->deletePattern('swep_cache:leave_applications:byUser:'. $leave_application->user_id .':*');

        $this->session->flash('LA_CREATE_SUCCESS', 'Your Leave Application has been successfully Created!');
        $this->session->flash('LA_CREATE_SUCCESS_SLUG', $leave_application->slug);

    }





    public function onUpdate($leave_application){

        $this->cacheHelper->deletePattern('swep_cache:leave_applications:all:*');
        $this->cacheHelper->deletePattern('swep_cache:leave_applications:byUser:'. $leave_application->user_id .':*');
        $this->cacheHelper->deletePattern('swep_cache:leave_applications:bySlug:'. $leave_application->slug .'');

        $this->session->flash('LA_UPDATE_SUCCESS', 'Your Leave Application has been successfully Updated!');
        $this->session->flash('LA_UPDATE_SUCCESS_SLUG', $leave_application->slug);

    }





    public function onDestroy($leave_application){

        $this->cacheHelper->deletePattern('swep_cache:leave_applications:all:*');
        $this->cacheHelper->deletePattern('swep_cache:leave_applications:byUser:'. $leave_application->user_id .':*');
        $this->cacheHelper->deletePattern('swep_cache:leave_applications:bySlug:'. $leave_application->slug .'');

        $this->session->flash('LA_DELETE_SUCCESS', 'Your Leave Application has been successfully Deleted!');

    }






}