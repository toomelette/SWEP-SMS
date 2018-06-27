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




    public function onStore(){
        
        $this->cacheHelper->deletePattern('swep_cache:project_codes:all:*');
        $this->cacheHelper->deletePattern('swep_cache:project_codes:global:all');
        $this->cacheHelper->deletePattern('swep_cache:api:response_project_codes_from_department:*');

        $this->session->flash('PROJECT_CODE_CREATE_SUCCESS', 'The Project Code has been successfully created!');

    }





    public function onUpdate($project_code){

        $this->cacheHelper->deletePattern('swep_cache:project_codes:all:*');
        $this->cacheHelper->deletePattern('swep_cache:project_codes:global:all');
        $this->cacheHelper->deletePattern('swep_cache:api:response_project_codes_from_department:*');
        $this->cacheHelper->deletePattern('swep_cache:project_codes:bySlug:'. $project_code->slug .'');

        $this->session->flash('PROJECT_CODE_UPDATE_SUCCESS', 'The Project Code has been successfully updated!');
        $this->session->flash('PROJECT_CODE_UPDATE_SUCCESS_SLUG', $project_code->slug);

    }





    public function onDestroy($project_code){

        $this->cacheHelper->deletePattern('swep_cache:project_codes:all:*');
        $this->cacheHelper->deletePattern('swep_cache:project_codes:global:all');
        $this->cacheHelper->deletePattern('swep_cache:api:response_project_codes_from_department:*');
        $this->cacheHelper->deletePattern('swep_cache:project_codes:bySlug:'. $project_code->slug .'');

        $this->session->flash('PROJECT_CODE_DELETE_SUCCESS', 'The Project Code has been successfully deleted!');

    }





}