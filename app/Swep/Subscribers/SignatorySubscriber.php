<?php 

namespace App\Swep\Subscribers;

use Auth;
use Carbon\Carbon;
use App\Models\Signatory;
use Illuminate\Support\Str;
use App\Swep\Helpers\CacheHelper;
use App\Swep\Helpers\DataTypeHelper;



class SignatorySubscriber{


    protected $signatory;
    protected $carbon;
    protected $str;
    protected $auth;



    public function __construct(Signatory $signatory, Carbon $carbon, Str $str){

        $this->signatory = $signatory;
        $this->carbon = $carbon;
        $this->str = $str;
        $this->auth = auth();

    }




    public function subscribe($events){

        $events->listen('signatory.create', 'App\Swep\Subscribers\SignatorySubscriber@onCreate');
        $events->listen('signatory.update', 'App\Swep\Subscribers\SignatorySubscriber@onUpdate');
        $events->listen('signatory.delete', 'App\Swep\Subscribers\SignatorySubscriber@onDelete');

    }




    public function onCreate($signatory, $request){

        $this->createDefaults($signatory);
        CacheHelper::deletePattern('swep_cache:signatories:all:*');
        CacheHelper::deletePattern('swep_cache:signatories:global:all');

    }





    public function onUpdate($signatory, $request){

        $this->updateDefaults($signatory);
        CacheHelper::deletePattern('swep_cache:signatories:all:*');
        CacheHelper::deletePattern('swep_cache:signatories:global:all');
        CacheHelper::deletePattern('swep_cache:signatories:bySlug:'. $signatory->slug .'');

    }





    public function onDelete($slug){

        CacheHelper::deletePattern('swep_cache:signatories:all:*');
        CacheHelper::deletePattern('swep_cache:signatories:global:all');
        CacheHelper::deletePattern('swep_cache:signatories:bySlug:'. $slug .'');

    }



    /** DEFAULTS **/


    public function createDefaults($signatory){

        $signatory->slug = $this->str->random(16);
        $signatory->signatory_id = $this->signatory->signatoryIdIncrement;

        $signatory->created_at = $this->carbon->now();
        $signatory->updated_at = $this->carbon->now();
        $signatory->ip_created = request()->ip();
        $signatory->ip_updated = request()->ip();
        $signatory->user_created = $this->auth->user()->username;
        $signatory->user_updated = $this->auth->user()->username;
        $signatory->save();

    }



    public function updateDefaults($signatory){

        $signatory->updated_at = $this->carbon->now();
        $signatory->ip_updated = request()->ip();
        $signatory->user_updated = $this->auth->user()->username;
        $signatory->save();
        
    }




}