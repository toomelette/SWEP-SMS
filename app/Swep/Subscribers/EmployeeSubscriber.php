<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class EmployeeSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('employee.store', 'App\Swep\Subscribers\EmployeeSubscriber@onStore');
        $events->listen('employee.update', 'App\Swep\Subscribers\EmployeeSubscriber@onUpdate');
        $events->listen('employee.destroy', 'App\Swep\Subscribers\EmployeeSubscriber@onDestroy');
        $events->listen('employee.service_record_store', 'App\Swep\Subscribers\EmployeeSubscriber@onServiceRecordStore');
        $events->listen('employee.service_record_update', 'App\Swep\Subscribers\EmployeeSubscriber@onServiceRecordUpdate');
        $events->listen('employee.service_record_destroy', 'App\Swep\Subscribers\EmployeeSubscriber@onServiceRecordDestroy');
        $events->listen('employee.training_store', 'App\Swep\Subscribers\EmployeeSubscriber@onTrainingStore');
        $events->listen('employee.training_update', 'App\Swep\Subscribers\EmployeeSubscriber@onTrainingUpdate');
        $events->listen('employee.training_destroy', 'App\Swep\Subscribers\EmployeeSubscriber@onTrainingDestroy');

    }




    public function onStore($employee){

        $this->__cache->deletePattern('swep_cache:employees:fetch:*');
        $this->__cache->deletePattern('swep_cache:employees:getAll');
        $this->__cache->deletePattern('swep_cache:employees:getByIsActive:'. $employee->is_active .'');

        $this->session->flash('EMPLOYEE_CREATE_SUCCESS', 'The Employee has been successfully created!');

    }





    public function onUpdate($employee){

        $this->__cache->deletePattern('swep_cache:employees:fetch:*');
        $this->__cache->deletePattern('swep_cache:employees:getAll');
        $this->__cache->deletePattern('swep_cache:employees:getbySlug:'. $employee->slug .'');
        $this->__cache->deletePattern('swep_cache:employees:getByIsActive:'. $employee->is_active .'');
        $this->__cache->deletePattern('swep_cache:employees:findBySlug:'. $employee->slug .'');
        $this->__cache->deletePattern('swep_cache:employees:findByUserId:'. $employee->user_id .'');

        $this->session->flash('EMPLOYEE_UPDATE_SUCCESS', 'The Employee has been successfully updated!');
        $this->session->flash('EMPLOYEE_UPDATE_SUCCESS_SLUG', $employee->slug);

    }





    public function onDestroy($employee){

        $this->__cache->deletePattern('swep_cache:employees:fetch:*');
        $this->__cache->deletePattern('swep_cache:employees:getAll');
        $this->__cache->deletePattern('swep_cache:employees:getbySlug:'. $employee->slug .'');
        $this->__cache->deletePattern('swep_cache:employees:getByIsActive:'. $employee->is_active .'');
        $this->__cache->deletePattern('swep_cache:employees:findBySlug:'. $employee->slug .'');
        $this->__cache->deletePattern('swep_cache:employees:findByUserId:'. $employee->user_id .'');

        $this->session->flash('EMPLOYEE_DELETE_SUCCESS', 'The Employee has been successfully deleted!');

    }





}