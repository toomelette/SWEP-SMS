<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class FundSourceSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }





    public function subscribe($events){

        $events->listen('fund_source.store', 'App\Swep\Subscribers\FundSourceSubscriber@onStore');
        $events->listen('fund_source.update', 'App\Swep\Subscribers\FundSourceSubscriber@onUpdate');
        $events->listen('fund_source.destroy', 'App\Swep\Subscribers\FundSourceSubscriber@onDestroy');

    }





    public function onStore(){

        $this->__cache->deletePattern('swep_cache:fund_sources:fetch:*');
        $this->__cache->deletePattern('swep_cache:fund_sources:getAll');

        $this->session->flash('FUND_SOURCE_CREATE_SUCCESS', 'The Fund Source has been successfully created!');

    }






    public function onUpdate($fund_source){

        $this->__cache->deletePattern('swep_cache:fund_sources:fetch:*');
        $this->__cache->deletePattern('swep_cache:fund_sources:getAll');
        $this->__cache->deletePattern('swep_cache:fund_sources:findBySlug:'. $fund_source->slug .'');

        $this->session->flash('FUND_SOURCE_UPDATE_SUCCESS', 'The Fund Source has been successfully updated!');
        $this->session->flash('FUND_SOURCE_UPDATE_SUCCESS_SLUG', $fund_source->slug);

    }






    public function onDestroy($fund_source){

        $this->__cache->deletePattern('swep_cache:fund_sources:fetch:*');
        $this->__cache->deletePattern('swep_cache:fund_sources:getAll');
        $this->__cache->deletePattern('swep_cache:fund_sources:findBySlug:'. $fund_source->slug .'');

        $this->session->flash('FUND_SOURCE_DELETE_SUCCESS', 'The Fund Source has been successfully deleted!');
        $this->session->flash('FUND_SOURCE_DELETE_SUCCESS_SLUG', $fund_source->slug);

    }






}