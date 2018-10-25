<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class ProjectCodeSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('project_code.store', 'App\Swep\Subscribers\ProjectCodeSubscriber@onStore');
        $events->listen('project_code.update', 'App\Swep\Subscribers\ProjectCodeSubscriber@onUpdate');
        $events->listen('project_code.destroy', 'App\Swep\Subscribers\ProjectCodeSubscriber@onDestroy');

    }




    public function onStore($project_code){
        
        $this->__cache->deletePattern('swep_cache:project_codes:fetch:*');
        $this->__cache->deletePattern('swep_cache:project_codes:getAll');
        $this->__cache->deletePattern('swep_cache:project_codes:getByDepartmentName:'. $project_code->department_name .'');

        $this->session->flash('PROJECT_CODE_CREATE_SUCCESS', 'The Project Code has been successfully created!');

    }





    public function onUpdate($project_code){

        $this->__cache->deletePattern('swep_cache:project_codes:fetch:*');
        $this->__cache->deletePattern('swep_cache:project_codes:getAll');
        $this->__cache->deletePattern('swep_cache:project_codes:getByDepartmentName:'. $project_code->department_name .'');
        $this->__cache->deletePattern('swep_cache:project_codes:findBySlug:'. $project_code->slug .'');

        $this->session->flash('PROJECT_CODE_UPDATE_SUCCESS', 'The Project Code has been successfully updated!');
        $this->session->flash('PROJECT_CODE_UPDATE_SUCCESS_SLUG', $project_code->slug);

    }





    public function onDestroy($project_code){

        $this->__cache->deletePattern('swep_cache:project_codes:fetch:*');
        $this->__cache->deletePattern('swep_cache:project_codes:getAll');
        $this->__cache->deletePattern('swep_cache:project_codes:getByDepartmentName:'. $project_code->department_name .'');
        $this->__cache->deletePattern('swep_cache:project_codes:findBySlug:'. $project_code->slug .'');

        $this->session->flash('PROJECT_CODE_DELETE_SUCCESS', 'The Project Code has been successfully deleted!');

    }





}