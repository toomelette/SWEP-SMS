<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class DepartmentSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }





    public function subscribe($events){

        $events->listen('department.store', 'App\Swep\Subscribers\DepartmentSubscriber@onStore');
        $events->listen('department.update', 'App\Swep\Subscribers\DepartmentSubscriber@onUpdate');
        $events->listen('department.destroy', 'App\Swep\Subscribers\DepartmentSubscriber@onDestroy');

    }





    public function onStore(){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:getAll');

        $this->session->flash('DEPARTMENT_CREATE_SUCCESS', 'The Department has been successfully created!');

    }





    public function onUpdate($department){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:getAll');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:findBySlug:'. $department->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:findByDepartmentId:'. $department->department_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:getByDepartmentId:'. $department->department_id .'');

        $this->session->flash('DEPARTMENT_UPDATE_SUCCESS', 'The Department has been successfully updated!');
        $this->session->flash('DEPARTMENT_UPDATE_SUCCESS_SLUG', $department->slug);

    }





    public function onDestroy($department){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:fetch:*');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:getAll');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:findBySlug:'. $department->slug .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:findByDepartmentId:'. $department->department_id .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:departments:getByDepartmentId:'. $department->department_id .'');

        $this->session->flash('DEPARTMENT_DELETE_SUCCESS', 'The Department has been successfully deleted!');
        
    }





}