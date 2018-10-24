<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class EmployeeTrainingSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('employee_training.store', 'App\Swep\Subscribers\EmployeeTrainingSubscriber@onStore');
        $events->listen('employee_training.update', 'App\Swep\Subscribers\EmployeeTrainingSubscriber@onUpdate');
        $events->listen('employee_training.destroy', 'App\Swep\Subscribers\EmployeeTrainingSubscriber@onDestroy');

    }





    public function onStore($employee_trng){

        $this->__cache->deletePattern('swep_cache:employees:trainings:byEmpNo:'. $employee_trng->employee_no .'');

        $this->session->flash('EMPLOYEE_TRNG_CREATE_SUCCESS_SLUG', $employee_trng->slug);

    }





    public function onUpdate($employee_trng){

        $this->__cache->deletePattern('swep_cache:employees:trainings:byEmpNo:'. $employee_trng->employee_no .'');
        $this->__cache->deletePattern('swep_cache:api:employees:trainings:bySlug:'. $employee_trng->slug .'');

        $this->session->flash('EMPLOYEE_TRNG_UPDATE_SUCCESS_SLUG', $employee_trng->slug);

    }





    public function onDestroy($employee_trng){

        $this->__cache->deletePattern('swep_cache:employees:trainings:byEmpNo:'. $employee_trng->employee_no .'');
        $this->__cache->deletePattern('swep_cache:api:employees:trainings:bySlug:'. $employee_trng->slug .'');
        
    }





}