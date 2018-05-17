<?php 

namespace App\Swep\BaseClasses;

use App;
use Session;
use App\Swep\Helpers\CacheHelper;


class BaseSubscriber{


    protected $session;
    protected $cacheHelper;



    public function __construct(){

        $this->session = session();
        $this->cacheHelper = App::make(CacheHelper::class);
        
    }





}