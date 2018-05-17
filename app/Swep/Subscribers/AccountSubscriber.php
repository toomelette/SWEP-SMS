<?php 

namespace App\Swep\Subscribers;


use App\Swep\BaseClasses\BaseSubscriber;



class AccountSubscriber extends BaseSubscriber{




    public function __construct(){

        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('account.store', 'App\Swep\Subscribers\AccountSubscriber@onStore');
        $events->listen('account.update', 'App\Swep\Subscribers\AccountSubscriber@onUpdate');
        $events->listen('account.destroy', 'App\Swep\Subscribers\AccountSubscriber@onDestroy');

    }




    public function onStore(){
        
        $this->cacheHelper->deletePattern('swep_cache:accounts:all:*');
        $this->cacheHelper->deletePattern('swep_cache:accounts:global:all');
        $this->cacheHelper->deletePattern('swep_cache:api:response_accounts_from_department:*');

        $this->session->flash('ACCOUNT_CREATE_SUCCESS', 'The Account has been successfully created!');

    }





    public function onUpdate($account){

        $this->cacheHelper->deletePattern('swep_cache:accounts:all:*');
        $this->cacheHelper->deletePattern('swep_cache:accounts:global:all');
        $this->cacheHelper->deletePattern('swep_cache:api:response_accounts_from_department:*');
        $this->cacheHelper->deletePattern('swep_cache:accounts:bySlug:'. $account->slug .'');

        $this->session->flash('ACCOUNT_UPDATE_SUCCESS', 'The Account has been successfully updated!');
        $this->session->flash('ACCOUNT_UPDATE_SUCCESS_SLUG', $account->slug);

    }





    public function onDestroy($account){

        $this->cacheHelper->deletePattern('swep_cache:accounts:all:*');
        $this->cacheHelper->deletePattern('swep_cache:accounts:global:all');
        $this->cacheHelper->deletePattern('swep_cache:api:response_accounts_from_department:*');
        $this->cacheHelper->deletePattern('swep_cache:accounts:bySlug:'. $account->slug .'');

        $this->session->flash('ACCOUNT_DELETE_SUCCESS', 'The Account has been successfully deleted!');

    }





}