<?php 

namespace App\Swep\BaseClasses;

use App;
use Auth;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Swep\Helpers\CacheHelper;
use App\Swep\Helpers\DataTypeHelper;


class BaseSubscriber{


    protected $str;
    protected $carbon;
    protected $session;
    protected $cacheHelper;
    protected $auth;



    public function __construct(){

        $this->str = App::make(Str::class);
        $this->carbon = App::make(Carbon::class);
        $this->cacheHelper = App::make(CacheHelper::class);
        $this->session = session();
        $this->auth = auth();

    }





}