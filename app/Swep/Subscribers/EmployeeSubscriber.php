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




    public function onStore(){

        $this->cacheHelper->deletePattern('swep_cache:employees:all:*');
        $this->cacheHelper->deletePattern('swep_cache:employees:global:all');
        $this->session->flash('EMPLOYEE_CREATE_SUCCESS', 'The Employee has been successfully created!');

    }





    public function onUpdate($employee){

        $this->cacheHelper->deletePattern('swep_cache:employees:all:*');
        $this->cacheHelper->deletePattern('swep_cache:employees:bySlug:'. $employee->slug .'');
        $this->cacheHelper->deletePattern('swep_cache:api:employees:bySlug:'. $employee->slug .'');
        $this->cacheHelper->deletePattern('swep_cache:employees:global:all');

        $this->session->flash('EMPLOYEE_UPDATE_SUCCESS', 'The Employee has been successfully updated!');
        $this->session->flash('EMPLOYEE_UPDATE_SUCCESS_SLUG', $employee->slug);

    }





    public function onDestroy($employee){

        $this->cacheHelper->deletePattern('swep_cache:employees:all:*');
        $this->cacheHelper->deletePattern('swep_cache:employees:bySlug:'. $employee->slug .'');
        $this->cacheHelper->deletePattern('swep_cache:api:employees:bySlug:'. $employee->slug .'');
        $this->cacheHelper->deletePattern('swep_cache:employees:global:all');

        $this->session->flash('EMPLOYEE_DELETE_SUCCESS', 'The Employee has been successfully deleted!');

    }





}