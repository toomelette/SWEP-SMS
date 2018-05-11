<?php 

namespace App\Swep\Subscribers;

use Auth;
use Carbon\Carbon;
use App\Models\FundSource;
use Illuminate\Support\Str;
use App\Swep\Helpers\CacheHelper;
use App\Swep\Helpers\DataTypeHelper;



class FundSourceSubscriber{


    protected $fund_source;
    protected $carbon;
    protected $str;
    protected $auth;



    public function __construct(FundSource $fund_source, Carbon $carbon, Str $str){

        $this->fund_source = $fund_source;
        $this->carbon = $carbon;
        $this->str = $str;
        $this->auth = auth();

    }




    public function subscribe($events){

        $events->listen('fund_source.create', 'App\Swep\Subscribers\FundSourceSubscriber@onCreate');
        $events->listen('fund_source.update', 'App\Swep\Subscribers\FundSourceSubscriber@onUpdate');
        $events->listen('fund_source.delete', 'App\Swep\Subscribers\FundSourceSubscriber@onDelete');

    }




    public function onCreate($fund_source, $request){

        $this->createDefaults($fund_source);
        CacheHelper::deletePattern('swep_cache:fund_sources:all:*');
        CacheHelper::deletePattern('swep_cache:fund_sources:all');

    }





    public function onUpdate($fund_source, $request){

        $this->updateDefaults($fund_source);
        CacheHelper::deletePattern('swep_cache:fund_sources:bySlug:'. $fund_source->slug .'');
        CacheHelper::deletePattern('swep_cache:fund_sources:all:*');
        CacheHelper::deletePattern('swep_cache:fund_sources:all');

    }





    public function onDelete($fund_source){

        CacheHelper::deletePattern('swep_cache:fund_sources:bySlug:'. $fund_source->slug .'');
        CacheHelper::deletePattern('swep_cache:fund_sources:all:*');
        CacheHelper::deletePattern('swep_cache:fund_sources:all');

    }



    /** DEFAULTS **/


    public function createDefaults($fund_source){

        $fund_source->slug = $this->str->random(16);
        $fund_source->fund_source_id = $this->fund_source->fundSourceIdIncrement;
        $fund_source->created_at = $this->carbon->now();
        $fund_source->updated_at = $this->carbon->now();
        $fund_source->machine_created = gethostname();
        $fund_source->machine_updated = gethostname();
        $fund_source->ip_created = request()->ip();
        $fund_source->ip_updated = request()->ip();
        $fund_source->user_created = $this->auth->user()->user_id;
        $fund_source->user_updated = $this->auth->user()->user_id;
        $fund_source->save();

    }



    public function updateDefaults($fund_source){

        $fund_source->updated_at = $this->carbon->now();
        $fund_source->machine_updated = gethostname();
        $fund_source->ip_updated = request()->ip();
        $fund_source->user_updated = $this->auth->user()->user_id;

    }




}