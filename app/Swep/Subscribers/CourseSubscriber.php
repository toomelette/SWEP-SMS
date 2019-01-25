<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class CourseSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }





    public function subscribe($events){

        $events->listen('course.store', 'App\Swep\Subscribers\CourseSubscriber@onStore');
        $events->listen('course.update', 'App\Swep\Subscribers\CourseSubscriber@onUpdate');
        $events->listen('course.destroy', 'App\Swep\Subscribers\CourseSubscriber@onDestroy');

    }





    public function onStore(){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:courses:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:courses:getAll');

        $this->session->flash('COURSE_CREATE_SUCCESS', 'The Course has been successfully created!');

    }





    public function onUpdate($course){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:courses:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:courses:getAll');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:courses:findBySlug:'. $course->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:courses:findByCourseId:'. $course->course_id .'');

        $this->session->flash('COURSE_UPDATE_SUCCESS', 'The Course has been successfully updated!');
        $this->session->flash('COURSE_UPDATE_SUCCESS_SLUG', $course->slug);

    }





    public function onDestroy($course){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:courses:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:courses:getAll');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:courses:findBySlug:'. $course->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:courses:findByCourseId:'. $course->course_id .'');

        $this->session->flash('COURSE_DELETE_SUCCESS', 'The Course has been successfully deleted!');
        
    }





}