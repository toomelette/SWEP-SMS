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
        $this->session->flash('EMPLOYEE_CREATE_SUCCESS', 'The Employee has been successfully created!');

    }





    public function onUpdate($employee){

        $this->cacheHelper->deletePattern('swep_cache:employees:all:*');
        $this->cacheHelper->deletePattern('swep_cache:employees:bySlug:'. $employee->slug .'');

        $this->session->flash('EMPLOYEE_UPDATE_SUCCESS', 'The Employee has been successfully updated!');
        $this->session->flash('EMPLOYEE_UPDATE_SUCCESS_SLUG', $employee->slug);

    }





    public function onDestroy($employee){

        $this->cacheHelper->deletePattern('swep_cache:employees:all:*');
        $this->cacheHelper->deletePattern('swep_cache:employees:bySlug:'. $employee->slug .'');

        $this->session->flash('EMPLOYEE_DELETE_SUCCESS', 'The Employee has been successfully deleted!');

    }








    public function onServiceRecordStore($employee_sr){

        $this->cacheHelper->deletePattern('swep_cache:employees:all:*');

    }




    public function onServiceRecordUpdate($employee_sr){

        $this->cacheHelper->deletePattern('swep_cache:employees:all:*');
        $this->cacheHelper->deletePattern('swep_cache:employees:service_records:bySlug:'. $employee_sr->slug .'');
        $this->cacheHelper->deletePattern('swep_cache:api:employees:employee_serviceRecords:bySlug:'. $employee_sr->slug .'');

        $this->session->flash('EMPLOYEE_SR_UPDATE_SUCCESS', 'The Employee Service Record has been successfully updated!');
        $this->session->flash('EMPLOYEE_SR_UPDATE_SUCCESS_SLUG', $employee_sr->slug);

    }




    public function onServiceRecordDestroy($employee_sr){

        $this->cacheHelper->deletePattern('swep_cache:employees:all:*');
        $this->cacheHelper->deletePattern('swep_cache:employees:service_records:bySlug:'. $employee_sr->slug .'');
        $this->cacheHelper->deletePattern('swep_cache:api:employees:employee_serviceRecords:bySlug:'. $employee_sr->slug .'');

    }









    public function onTrainingStore($employee_trng){

        $this->cacheHelper->deletePattern('swep_cache:employees:all:*');

    }




    public function onTrainingUpdate($employee_trng){

        $this->cacheHelper->deletePattern('swep_cache:employees:all:*');
        $this->cacheHelper->deletePattern('swep_cache:employees:trainings:bySlug:'. $employee_trng->slug .'');
        $this->cacheHelper->deletePattern('swep_cache:api:employees:employee_trainings:bySlug:'. $employee_trng->slug .'');

        $this->session->flash('EMPLOYEE_TRNG_UPDATE_SUCCESS', 'The Employee Service Record has been successfully updated!');
        $this->session->flash('EMPLOYEE_TRNG_UPDATE_SUCCESS_SLUG', $employee_trng->slug);

    }




    public function onTrainingDestroy($employee_trng){

        $this->cacheHelper->deletePattern('swep_cache:employees:all:*');
        $this->cacheHelper->deletePattern('swep_cache:employees:trainings:bySlug:'. $employee_trng->slug .'');
        $this->cacheHelper->deletePattern('swep_cache:api:employees:employee_trainings:bySlug:'. $employee_trng->slug .'');

    }




}