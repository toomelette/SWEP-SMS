<?php 

namespace App\Swep\Subscribers;

use Auth;
use Carbon\Carbon;
use App\Models\DepartmentUnit;
use Illuminate\Support\Str;
use App\Swep\Helpers\CacheHelper;
use App\Swep\Helpers\DataTypeHelper;



class DepartmentUnitSubscriber{


    protected $department_unit;
    protected $carbon;
    protected $str;
    protected $auth;



    public function __construct(DepartmentUnit $department_unit, Carbon $carbon, Str $str){

        $this->department_unit = $department_unit;
        $this->carbon = $carbon;
        $this->str = $str;
        $this->auth = auth();

    }




    public function subscribe($events){

        $events->listen('department_unit.create', 'App\Swep\Subscribers\DepartmentUnitSubscriber@onCreate');
        $events->listen('department_unit.update', 'App\Swep\Subscribers\DepartmentUnitSubscriber@onUpdate');
        $events->listen('department_unit.delete', 'App\Swep\Subscribers\DepartmentUnitSubscriber@onDelete');

    }




    public function onCreate($department_unit, $request){

        $this->createDefaults($department_unit);
        CacheHelper::deletePattern('swep_cache:department_units:all:*');
        CacheHelper::deletePattern('swep_cache:department_units:global:all');
        CacheHelper::deletePattern('swep_cache:api:response_department_units_from_department:*');

    }





    public function onUpdate($department_unit, $request){

        $this->updateDefaults($department_unit);
        CacheHelper::deletePattern('swep_cache:department_units:all:*');
        CacheHelper::deletePattern('swep_cache:department_units:global:all');
        CacheHelper::deletePattern('swep_cache:api:response_department_units_from_department:*');
        CacheHelper::deletePattern('swep_cache:department_units:bySlug:'. $department_unit->slug .'');

    }





    public function onDelete($department_unit){

        CacheHelper::deletePattern('swep_cache:department_units:all:*');
        CacheHelper::deletePattern('swep_cache:department_units:global:all');
        CacheHelper::deletePattern('swep_cache:api:response_department_units_from_department:*');
        CacheHelper::deletePattern('swep_cache:department_units:bySlug:'. $department_unit->slug .'');

    }



    /** DEFAULTS **/


    public function createDefaults($department_unit){

        $department_unit->slug = $this->str->random(16);
        $department_unit->department_Unit_id = $this->department_unit->departmentUnitIdIncrement;

        $department_unit->created_at = $this->carbon->now();
        $department_unit->updated_at = $this->carbon->now();
        $department_unit->ip_created = request()->ip();
        $department_unit->ip_updated = request()->ip();
        $department_unit->user_created = $this->auth->user()->username;
        $department_unit->user_updated = $this->auth->user()->username;
        $department_unit->save();

    }



    public function updateDefaults($department_unit){

        $department_unit->updated_at = $this->carbon->now();
        $department_unit->ip_updated = request()->ip();
        $department_unit->user_updated = $this->auth->user()->username;
        $department_unit->save();

    }




}