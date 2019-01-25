<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class EmployeeServiceRecordSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('employee_service_record.store', 'App\Swep\Subscribers\EmployeeServiceRecordSubscriber@onStore');
        $events->listen('employee_service_record.update', 'App\Swep\Subscribers\EmployeeServiceRecordSubscriber@onUpdate');
        $events->listen('employee_service_record.destroy', 'App\Swep\Subscribers\EmployeeServiceRecordSubscriber@onDestroy');

    }




    public function onStore($employee_sr){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:employees:service_records:getByEmpNo:'. $employee_sr->employee_no .'');

        $this->session->flash('EMPLOYEE_SR_CREATE_SUCCESS_SLUG', $employee_sr->slug);

    }




    public function onUpdate($employee_sr){

        $this->__cache->deletePattern(''. config('app.name') .'_cache:employees:service_records:getByEmpNo:'. $employee_sr->employee_no .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:employees:service_records:getBySlug:'. $employee_sr->slug .'');

        $this->session->flash('EMPLOYEE_SR_UPDATE_SUCCESS_SLUG', $employee_sr->slug);

    }




    public function onDestroy($employee_sr){
        
        $this->__cache->deletePattern(''. config('app.name') .'_cache:employees:service_records:getByEmpNo:'. $employee_sr->employee_no .'');
        $this->__cache->deletePattern(''. config('app.name') .'_cache:employees:service_records:getBySlug:'. $employee_sr->slug .'');

    }





}