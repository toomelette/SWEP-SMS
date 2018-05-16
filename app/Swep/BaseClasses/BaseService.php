<?php
 
namespace App\Swep\BaseClasses;


use App;
use Auth;
use Session;
use Carbon\Carbon;
use Illuminate\Events\Dispatcher;
use Illuminate\Cache\Repository as Cache;


class BaseService{


    protected $event;
    protected $cache;
    protected $carbon;
    protected $session;
    protected $auth;   



    public function __construct(){
        
        $this->event = App::make(Dispatcher::class);
        $this->cache = App::make(Cache::class);
        $this->carbon = App::make(Carbon::class);
        $this->session = session();
        $this->auth = auth();

    }




}