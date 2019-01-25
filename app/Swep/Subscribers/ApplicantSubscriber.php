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
        $events->listen('applicant.add_to_shortist', 'App\Swep\Subscribers\ApplicantSubscriber@onAddToShortList');
        $events->listen('applicant.remove_to_shortist', 'App\Swep\Subscribers\ApplicantSubscriber@onRemoveToShortList');

    }





    public function onStore($applicant){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByCourseId:'. $applicant->course_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByDeptUnitId:'. $applicant->department_unit_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByCourseIdShortlist:'. $applicant->course_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByDeptUnitIdShortlist:'. $applicant->department_unit_id .'');

        $this->session->flash('APPLICANT_CREATE_SUCCESS', 'The Applicant has been successfully created!');

    }





    public function onUpdate($applicant){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:findBySlug:'. $applicant->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByCourseId:'. $applicant->course_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByDeptUnitId:'. $applicant->department_unit_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByCourseIdShortlist:'. $applicant->course_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByDeptUnitIdShortlist:'. $applicant->department_unit_id .'');

        $this->session->flash('APPLICANT_UPDATE_SUCCESS', 'The Applicant has been successfully updated!');
        $this->session->flash('APPLICANT_UPDATE_SUCCESS_SLUG', $applicant->slug);

    }





    public function onDestroy($applicant){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:findBySlug:'. $applicant->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByCourseId:'. $applicant->course_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByDeptUnitId:'. $applicant->department_unit_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByCourseIdShortlist:'. $applicant->course_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByDeptUnitIdShortlist:'. $applicant->department_unit_id .'');

        $this->session->flash('APPLICANT_DELETE_SUCCESS', 'The Applicant has been successfully deleted!');
        
    }





    public function onAddToShortList($applicant){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:findBySlug:'. $applicant->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByCourseId:'. $applicant->course_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByDeptUnitId:'. $applicant->department_unit_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByCourseIdShortlist:'. $applicant->course_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByDeptUnitIdShortlist:'. $applicant->department_unit_id .'');

        $this->session->flash('APPLICANT_ADD_SL_SUCCESS', 'The Applicant has been successfully added to Shortlist!');
        $this->session->flash('APPLICANT_ADD_SL_SUCCESS_SLUG', $applicant->slug);

    }





    public function onRemoveToShortList($applicant){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:findBySlug:'. $applicant->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByCourseId:'. $applicant->course_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByDeptUnitId:'. $applicant->department_unit_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByCourseIdShortlist:'. $applicant->course_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:applicants:getByDeptUnitIdShortlist:'. $applicant->department_unit_id .'');

        $this->session->flash('APPLICANT_REMOVE_SL_SUCCESS', 'The Applicant has been successfully removed to Shortlist!');
        $this->session->flash('APPLICANT_REMOVE_SL_SUCCESS_SLUG', $applicant->slug);

    }





}