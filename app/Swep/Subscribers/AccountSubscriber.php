<?php 

namespace App\Swep\Subscribers;

use Session;
use App\Models\Account;
use App\Swep\Helpers\DataTypeHelper;
use App\Swep\BaseClasses\BaseSubscriber;



class AccountSubscriber extends BaseSubscriber{


    protected $account;



    public function __construct(Account $account){

        $this->account = $account;
        parent::__construct();

    }




    public function subscribe($events){

        $events->listen('account.store', 'App\Swep\Subscribers\AccountSubscriber@onStore');
        $events->listen('account.update', 'App\Swep\Subscribers\AccountSubscriber@onUpdate');
        $events->listen('account.delete', 'App\Swep\Subscribers\AccountSubscriber@onDelete');

    }




    public function onStore($account){

        $this->accountCreateDefaults($account);
        
        $this->cacheHelper->deletePattern('swep_cache:accounts:all:*');
        $this->cacheHelper->deletePattern('swep_cache:accounts:global:all');
        $this->cacheHelper->deletePattern('swep_cache:api:response_accounts_from_department:*');

        $this->session->flash('ACCOUNT_CREATE_SUCCESS', 'The Account has been successfully created!');

    }





    public function onUpdate($account, $request){

        $this->updateDefaults($account);

        $this->cacheHelper->deletePattern('swep_cache:accounts:all:*');
        $this->cacheHelper->deletePattern('swep_cache:accounts:global:all');
        $this->cacheHelper->deletePattern('swep_cache:api:response_accounts_from_department:*');
        $this->cacheHelper->deletePattern('swep_cache:accounts:bySlug:'. $account->slug .'');

        $this->session->flash('ACCOUNT_UPDATE_SUCCESS', 'The Account has been successfully updated!');
        $this->session->flash('ACCOUNT_UPDATE_SUCCESS_SLUG', $account->slug);

    }





    public function onDelete($account){

        $this->cacheHelper->deletePattern('swep_cache:accounts:all:*');
        $this->cacheHelper->deletePattern('swep_cache:accounts:global:all');
        $this->cacheHelper->deletePattern('swep_cache:api:response_accounts_from_department:*');
        $this->cacheHelper->deletePattern('swep_cache:accounts:bySlug:'. $account->slug .'');

    }




    /** DEFAULTS **/

    public function accountCreateDefaults($account){

        $account->slug = $this->str->random(16);
        $account->account_id = $this->account->accountIdIncrement;
        $account->created_at = $this->carbon->now();
        $account->updated_at = $this->carbon->now();
        $account->ip_created = request()->ip();
        $account->ip_updated = request()->ip();
        $account->user_created = $this->auth->user()->username;
        $account->user_updated = $this->auth->user()->username;
        $account->save();

    }





    public function updateDefaults($account){

        $account->updated_at = $this->carbon->now();
        $account->ip_updated = request()->ip();
        $account->user_updated = $this->auth->user()->username;

    }




}