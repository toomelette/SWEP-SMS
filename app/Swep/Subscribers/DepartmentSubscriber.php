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

        $this->cacheHelper->deletePattern('swep_cache:departments:all:*');
        $this->cacheHelper->deletePattern('swep_cache:departments:global:all');
        $this->cacheHelper->deletePattern('swep_cache:api:response_departments_from_department:*');

        $this->session->flash('DEPARTMENT_CREATE_SUCCESS', 'The Department has been successfully created!');

    }





    public function onUpdate($department){

        $this->cacheHelper->deletePattern('swep_cache:departments:all:*');
        $this->cacheHelper->deletePattern('swep_cache:departments:global:all');
        $this->cacheHelper->deletePattern('swep_cache:api:response_departments_from_department:*');
        $this->cacheHelper->deletePattern('swep_cache:departments:bySlug:'. $department->slug .'');

        $this->session->flash('DEPARTMENT_UPDATE_SUCCESS', 'The Department has been successfully updated!');
        $this->session->flash('DEPARTMENT_UPDATE_SUCCESS_SLUG', $department->slug);

    }





    public function onDestroy($department){

        $this->cacheHelper->deletePattern('swep_cache:departments:all:*');
        $this->cacheHelper->deletePattern('swep_cache:departments:global:all');
        $this->cacheHelper->deletePattern('swep_cache:api:response_departments_from_department:*');
        $this->cacheHelper->deletePattern('swep_cache:departments:bySlug:'. $department->slug .'');

        $this->session->flash('DEPARTMENT_DELETE_SUCCESS', 'The Department has been successfully deleted!');
        
    }





}