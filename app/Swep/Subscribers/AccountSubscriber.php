<?php 

namespace App\Swep\Subscribers;

use Auth;
use Carbon\Carbon;
use App\Models\Account;
use Illuminate\Support\Str;
use App\Swep\Helpers\CacheHelper;
use App\Swep\Helpers\DataTypeHelper;



class AccountSubscriber{


    protected $account;
    protected $carbon;
    protected $str;
    protected $auth;



    public function __construct(Account $account, Carbon $carbon, Str $str){

        $this->account = $account;
        $this->carbon = $carbon;
        $this->str = $str;
        $this->auth = auth();

    }




    public function subscribe($events){

        $events->listen('account.create', 'App\Swep\Subscribers\AccountSubscriber@onCreate');
        $events->listen('account.update', 'App\Swep\Subscribers\AccountSubscriber@onUpdate');
        $events->listen('account.delete', 'App\Swep\Subscribers\AccountSubscriber@onDelete');

    }




    public function onCreate($account, $request){

        $this->createDefaults($account);

        $account->mooe = $request->mooe == null ? null : str_replace(',', '', $request->mooe);
        $account->co = $request->co == null ? null : str_replace(',', '', $request->co);
        $account->date_started = $request->date_started == null ? null : $this->carbon->parse($request->date_started)->format('Y-m-d');
        $account->projected_date_end = $request->date_started == null ? null : $this->carbon->parse($request->projected_date_end)->format('Y-m-d');
        $account->save();

        CacheHelper::deletePattern('swep_cache:accounts:all:*');
        CacheHelper::deletePattern('swep_cache:accounts:global:all');
        CacheHelper::deletePattern('swep_cache:api:response_accounts_from_department:*');

    }





    public function onUpdate($account, $request){

        $this->updateDefaults($account);

        $account->mooe = $request->mooe == null ? null : str_replace(',', '', $request->mooe);
        $account->co = $request->co == null ? null : str_replace(',', '', $request->co);
        $account->date_started = $request->date_started == null ? null : $this->carbon->parse($request->date_started)->format('Y-m-d');
        $account->projected_date_end = $request->date_started == null ? null : $this->carbon->parse($request->projected_date_end)->format('Y-m-d');
        $account->save();

        CacheHelper::deletePattern('swep_cache:accounts:all:*');
        CacheHelper::deletePattern('swep_cache:accounts:global:all');
        CacheHelper::deletePattern('swep_cache:api:response_accounts_from_department:*');
        CacheHelper::deletePattern('swep_cache:accounts:bySlug:'. $account->slug .'');

    }





    public function onDelete($account){

        CacheHelper::deletePattern('swep_cache:accounts:all:*');
        CacheHelper::deletePattern('swep_cache:accounts:global:all');
        CacheHelper::deletePattern('swep_cache:api:response_accounts_from_department:*');
        CacheHelper::deletePattern('swep_cache:accounts:bySlug:'. $account->slug .'');

    }



    /** DEFAULTS **/


    public function createDefaults($account){

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
        $account->save();

    }




}