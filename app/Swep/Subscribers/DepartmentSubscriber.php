<?php 

namespace App\Swep\Subscribers;

use Auth;
use Carbon\Carbon;
use App\Models\Department;
use Illuminate\Support\Str;
use App\Swep\Helpers\CacheHelper;
use App\Swep\Helpers\DataTypeHelper;



class DepartmentSubscriber{


    protected $department;
    protected $carbon;
    protected $str;
    protected $auth;



    public function __construct(Department $department, Carbon $carbon, Str $str){

        $this->department = $department;
        $this->carbon = $carbon;
        $this->str = $str;
        $this->auth = auth();

    }




    public function subscribe($events){

        $events->listen('department.create', 'App\Swep\Subscribers\DepartmentSubscriber@onCreate');
        $events->listen('department.update', 'App\Swep\Subscribers\DepartmentSubscriber@onUpdate');
        $events->listen('department.delete', 'App\Swep\Subscribers\DepartmentSubscriber@onDelete');

    }




    public function onCreate($department, $request){

        $this->createDefaults($department);
        CacheHelper::deletePattern('swep_cache:departments:all:*');
        CacheHelper::deletePattern('swep_cache:departments:global:all');
        CacheHelper::deletePattern('swep_cache:api:response_departments_from_department:*');

    }





    public function onUpdate($department, $request){

        $this->updateDefaults($department);
        CacheHelper::deletePattern('swep_cache:departments:all:*');
        CacheHelper::deletePattern('swep_cache:departments:global:all');
        CacheHelper::deletePattern('swep_cache:api:response_departments_from_department:*');
        CacheHelper::deletePattern('swep_cache:departments:bySlug:'. $department->slug .'');

    }





    public function onDelete($department){

        CacheHelper::deletePattern('swep_cache:departments:all:*');
        CacheHelper::deletePattern('swep_cache:departments:global:all');
        CacheHelper::deletePattern('swep_cache:api:response_departments_from_department:*');
        CacheHelper::deletePattern('swep_cache:departments:bySlug:'. $department->slug .'');

    }



    /** DEFAULTS **/


    public function createDefaults($department){

        $department->slug = $this->str->random(16);
        $department->department_id = $this->department->departmentIdIncrement;
        
        $department->created_at = $this->carbon->now();
        $department->updated_at = $this->carbon->now();
        $department->ip_created = request()->ip();
        $department->ip_updated = request()->ip();
        $department->user_created = $this->auth->user()->username;
        $department->user_updated = $this->auth->user()->username;
        $department->save();

    }



    public function updateDefaults($department){

        $department->updated_at = $this->carbon->now();
        $department->ip_updated = request()->ip();
        $department->user_updated = $this->auth->user()->username;
        $department->save();

    }




}