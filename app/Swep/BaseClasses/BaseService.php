<?php
 
namespace App\Swep\BaseClasses;


use App;
use Auth;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Events\Dispatcher;
use App\Swep\Helpers\StaticHelper;
use App\Swep\Helpers\DataTypeHelper;
use Illuminate\Cache\Repository as Cache;
use Illuminate\Filesystem\FilesystemManager as Storage;


class BaseService{



    protected $auth;
    protected $session;
    protected $carbon;
    protected $str;
    protected $event;
    protected $staticHelper;
    protected $dataTypeHelper;
    protected $storage;
    protected $cache;



    public function __construct(){
        
        $this->auth = auth();
        $this->session = session();
        $this->carbon = App::make(Carbon::class);
        $this->str = App::make(Str::class);
        $this->event = App::make(Dispatcher::class);
        $this->staticHelper = App::make(StaticHelper::class);
        $this->dataTypeHelper = App::make(DataTypeHelper::class);
        $this->storage = App::make(Storage::class);
        $this->cache = App::make(Cache::class);
        
    }




}