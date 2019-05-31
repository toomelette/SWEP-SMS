<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class EmployeeMatrixSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }





    public function subscribe($events){

        $events->listen('employee_matrix.update', 'App\Swep\Subscribers\EmployeeMatrixSubscriber@onUpdate');

    }





    public function onUpdate($employee){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:employees:findBySlug:'. $employee->slug .'');

        $this->session->flash('EMPLOYEE_MATRIX_UPDATE_SUCCESS', 'The Matrix has been successfully updated!');
        $this->session->flash('EMPLOYEE_MATRIX_UPDATE_SUCCESS_SLUG', $employee->slug);

    }





}