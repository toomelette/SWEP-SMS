<?php 

namespace App\Swep\Subscribers;

use Auth;
use Carbon\Carbon;
use App\Models\Signatory;
use Illuminate\Support\Str;
use App\Swep\Helpers\CacheHelper;
use App\Swep\Helpers\DataTypeHelper;



class SignatoriesSubscriber{


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

        $events->listen('signatories.create', 'App\Swep\Subscribers\SignatoriesSubscriber@onCreate');
        $events->listen('signatories.update', 'App\Swep\Subscribers\SignatoriesSubscriber@onUpdate');
        $events->listen('signatories.delete', 'App\Swep\Subscribers\SignatoriesSubscriber@onDelete');

    }




    public function onCreate($signatory, $request){

        $this->createDefaults($signatory);
        CacheHelper::deletePattern('swep_cache:signatories:all:*');

    }





    public function onUpdate($signatory, $request){

        $this->updateDefaults($signatory);
        CacheHelper::deletePattern('swep_cache:signatories:all:*');
        CacheHelper::deletePattern('swep_cache:signatories:bySlug:'. $signatory->slug .'');

    }





    public function onDelete($slug){

        CacheHelper::deletePattern('swep_cache:signatories:all:*');
        CacheHelper::deletePattern('swep_cache:signatories:bySlug:'. $slug .'');

    }



    /** DEFAULTS **/


    public function createDefaults($signatory){

        $signatory->slug = $this->str->random(16);
        $signatory->created_at = $this->carbon->now();
        $signatory->updated_at = $this->carbon->now();
        $signatory->machine_created = gethostname();
        $signatory->machine_updated = gethostname();
        $signatory->ip_created = request()->ip();
        $signatory->ip_updated = request()->ip();
        $signatory->user_created = $this->auth->user()->user_id;
        $signatory->user_updated = $this->auth->user()->user_id;
        $signatory->save();

    }



    public function updateDefaults($signatory){

        $signatory->updated_at = $this->carbon->now();
        $signatory->machine_updated = gethostname();
        $signatory->ip_updated = request()->ip();
        $signatory->user_updated = $this->auth->user()->user_id;

    }




}