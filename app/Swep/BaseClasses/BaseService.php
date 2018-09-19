<?php
 
namespace App\Swep\BaseClasses;


use App;
use Auth;
use Session;
use Illuminate\Support\Str;
use App\Swep\Helpers\__static;
use App\Swep\Helpers\__dataType;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\FilesystemManager as Storage;


class BaseService{



    protected $auth;
    protected $session;
    protected $str;
    protected $__static;
    protected $__dataType;
    protected $event;
    protected $storage;



    public function __construct(){
        
        $this->auth = auth();
        $this->session = session();
        $this->str = App::make(Str::class);
        $this->__static = App::make(__static::class);
        $this->__dataType = App::make(__dataType::class);
        $this->event = App::make(Dispatcher::class);
        $this->storage = App::make(Storage::class);
        
    }




}