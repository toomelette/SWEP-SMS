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

    }




    public function onStore(){

        $this->cacheHelper->deletePattern('swep_cache:employees:all:*');
        $this->session->flash('EMPLOYEE_CREATE_SUCCESS', 'The Employee has been successfully created!');

    }





    public function onUpdate($account){



    }





    public function onDestroy($account){


    }





}