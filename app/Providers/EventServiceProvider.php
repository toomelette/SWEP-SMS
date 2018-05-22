<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider{


   
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];




    public function boot(){

        parent::boot();

    }




    protected $subscribe = [

        'App\Swep\Subscribers\DisbursementVoucherSubscriber',
        'App\Swep\Subscribers\UserSubscriber',
        'App\Swep\Subscribers\ProfileSubscriber',
        'App\Swep\Subscribers\MenuSubscriber',
        'App\Swep\Subscribers\SignatorySubscriber',
        'App\Swep\Subscribers\DepartmentSubscriber',
        'App\Swep\Subscribers\DepartmentUnitSubscriber',
        'App\Swep\Subscribers\AccountSubscriber',
        'App\Swep\Subscribers\FundSourceSubscriber',
        'App\Swep\Subscribers\SubmenuSubscriber',
        'App\Swep\Subscribers\LeaveApplicationSubscriber',

    ];





}
