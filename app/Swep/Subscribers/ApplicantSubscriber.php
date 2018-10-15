<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class ApplicantSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }





    public function subscribe($events){

        $events->listen('applicant.store', 'App\Swep\Subscribers\ApplicantSubscriber@onStore');
        $events->listen('applicant.update', 'App\Swep\Subscribers\ApplicantSubscriber@onUpdate');
        $events->listen('applicant.destroy', 'App\Swep\Subscribers\ApplicantSubscriber@onDestroy');

    }





    public function onStore(){

        $this->__cache->deletePattern('swep_cache:applicants:all:*');

        $this->session->flash('APPLICANT_CREATE_SUCCESS', 'The Applicant has been successfully created!');

    }





    public function onUpdate($applicant){

        $this->__cache->deletePattern('swep_cache:applicants:all:*');
        $this->__cache->deletePattern('swep_cache:applicants:bySlug:'. $applicant->slug .'');

        $this->session->flash('APPLICANT_UPDATE_SUCCESS', 'The Applicant has been successfully updated!');
        $this->session->flash('APPLICANT_UPDATE_SUCCESS_SLUG', $applicant->slug);

    }





    public function onDestroy($applicant){

        $this->__cache->deletePattern('swep_cache:applicants:all:*');
        $this->__cache->deletePattern('swep_cache:applicants:bySlug:'. $applicant->slug .'');

        $this->session->flash('APPLICANT_DELETE_SUCCESS', 'The Applicant has been successfully deleted!');
        
    }





}