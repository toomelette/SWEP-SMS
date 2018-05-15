<?php 

namespace App\Swep\Subscribers;

use Auth;
use Carbon\Carbon;
use App\Models\Submenu;
use Illuminate\Support\Str;
use App\Swep\Helpers\CacheHelper;
use App\Swep\Helpers\DataTypeHelper;



class SubmenuSubscriber{


    protected $submenu;
    protected $carbon;
    protected $str;
    protected $auth;



    public function __construct(Submenu $submenu, Carbon $carbon, Str $str){

        $this->submenu = $submenu;
        $this->carbon = $carbon;
        $this->str = $str;
        $this->auth = auth();

    }




    public function subscribe($events){

        $events->listen('submenu.update', 'App\Swep\Subscribers\SubmenuSubscriber@onUpdate');
        $events->listen('submenu.delete', 'App\Swep\Subscribers\SubmenuSubscriber@onDelete');

    }




    public function onUpdate($submenu, $request){

        $this->updateDefaults($submenu);

        $submenu->is_nav = DataTypeHelper::boolean($request->is_nav);
        $submenu->save();

        CacheHelper::deletePattern('swep_cache:submenus:bySlug:'. $submenu->slug .'');
        CacheHelper::deletePattern('swep_cache:submenus:all:*');
        CacheHelper::deletePattern('swep_cache:submenus:global:all');

        CacheHelper::deletePattern('swep_cache:api:response_submenus_from_menu:*');

    }





    public function onDelete($submenu){

        CacheHelper::deletePattern('swep_cache:submenus:bySlug:'. $submenu->slug .'');
        CacheHelper::deletePattern('swep_cache:submenus:all:*');
        CacheHelper::deletePattern('swep_cache:submenus:global:all');
        
        CacheHelper::deletePattern('swep_cache:api:response_submenus_from_menu:*');

    }



    /** DEFAULTS **/


    public function updateDefaults($submenu){

        $submenu->updated_at = $this->carbon->now();
        $submenu->ip_updated = request()->ip();
        $submenu->user_updated = $this->auth->user()->user_id;

    }




}