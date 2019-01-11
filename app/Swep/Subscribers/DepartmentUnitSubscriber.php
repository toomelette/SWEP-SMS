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




    public function onStore($department_unit){

        $this->__cache->deletePattern('swep_cache:department_units:fetch:*');
        $this->__cache->deletePattern('swep_cache:department_units:getAll');
        $this->__cache->deletePattern('swep_cache:department_units:getByDepartmentName:'. $department_unit->department_name .'');
        $this->__cache->deletePattern('swep_cache:department_units:getByDepartmentId:'. $department_unit->department_id .'');

        $this->session->flash('DEPARTMENT_UNIT_CREATE_SUCCESS', 'The Department Unit has been successfully created!');

    }





    public function onUpdate($department_unit){

        $this->__cache->deletePattern('swep_cache:department_units:fetch:*');
        $this->__cache->deletePattern('swep_cache:department_units:getAll');
        $this->__cache->deletePattern('swep_cache:department_units:getByDepartmentName:'. $department_unit->department_name .'');
        $this->__cache->deletePattern('swep_cache:department_units:getByDepartmentId:'. $department_unit->department_id .'');
        $this->__cache->deletePattern('swep_cache:department_units:findBySlug:'. $department_unit->slug .'');
        $this->__cache->deletePattern('swep_cache:department_units:findByDeptUnitId:'. $department_unit->department_unit_id .'');

        $this->session->flash('DEPARTMENT_UNIT_UPDATE_SUCCESS', 'The Department Unit has been successfully updated!');
        $this->session->flash('DEPARTMENT_UNIT_UPDATE_SUCCESS_SLUG', $department_unit->slug);
    }





    public function onDestroy($department_unit){

        $this->__cache->deletePattern('swep_cache:department_units:fetch:*');
        $this->__cache->deletePattern('swep_cache:department_units:getAll');
        $this->__cache->deletePattern('swep_cache:department_units:getByDepartmentName:'. $department_unit->department_name .'');
        $this->__cache->deletePattern('swep_cache:department_units:getByDepartmentId:'. $department_unit->department_id .'');
        $this->__cache->deletePattern('swep_cache:department_units:findBySlug:'. $department_unit->slug .'');
        $this->__cache->deletePattern('swep_cache:department_units:findByDeptUnitId:'. $department_unit->department_unit_id .'');

        $this->session->flash('DEPARTMENT_UNIT_DELETE_SUCCESS', 'The Department Unit has been successfully deleted!');

    }





}