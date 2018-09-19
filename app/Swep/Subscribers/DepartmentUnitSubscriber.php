<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class DepartmentUnitSubscriber extends BaseSubscriber{



    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('department_unit.store', 'App\Swep\Subscribers\DepartmentUnitSubscriber@onStore');
        $events->listen('department_unit.update', 'App\Swep\Subscribers\DepartmentUnitSubscriber@onUpdate');
        $events->listen('department_unit.destroy', 'App\Swep\Subscribers\DepartmentUnitSubscriber@onDestroy');

    }




    public function onStore(){

        $this->__cache->deletePattern('swep_cache:department_units:all:*');
        $this->__cache->deletePattern('swep_cache:department_units:global:all');
        $this->__cache->deletePattern('swep_cache:api:department_units:*');

        $this->session->flash('DEPARTMENT_UNIT_CREATE_SUCCESS', 'The Department Unit has been successfully created!');

    }





    public function onUpdate($department_unit){

        $this->__cache->deletePattern('swep_cache:department_units:all:*');
        $this->__cache->deletePattern('swep_cache:department_units:global:all');
        $this->__cache->deletePattern('swep_cache:api:department_units:*');
        $this->__cache->deletePattern('swep_cache:department_units:bySlug:'. $department_unit->slug .'');

        $this->session->flash('DEPARTMENT_UNIT_UPDATE_SUCCESS', 'The Department Unit has been successfully updated!');
        $this->session->flash('DEPARTMENT_UNIT_UPDATE_SUCCESS_SLUG', $department_unit->slug);
    }





    public function onDestroy($department_unit){

        $this->__cache->deletePattern('swep_cache:department_units:all:*');
        $this->__cache->deletePattern('swep_cache:department_units:global:all');
        $this->__cache->deletePattern('swep_cache:api:department_units:*');
        $this->__cache->deletePattern('swep_cache:department_units:bySlug:'. $department_unit->slug .'');

        $this->session->flash('DEPARTMENT_UNIT_DELETE_SUCCESS', 'The Department Unit has been successfully deleted!');

    }





}