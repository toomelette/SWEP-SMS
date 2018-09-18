<?php
 
namespace App\Swep\BaseClasses;


use App;
use Auth;
use Session;
use Illuminate\Support\Str;
use Illuminate\Events\Dispatcher;
use App\Swep\Helpers\StaticHelper;
use App\Swep\Helpers\DataTypeHelper;
use Illuminate\Filesystem\FilesystemManager as Storage;


class BaseService{



    protected $auth;
    protected $session;
    protected $str;
    protected $event;
    protected $staticHelper;
    protected $dataTypeHelper;
    protected $storage;



    public function __construct(){
        
        $this->auth = auth();
        $this->session = session();
        $this->str = App::make(Str::class);
        $this->event = App::make(Dispatcher::class);
        $this->staticHelper = App::make(StaticHelper::class);
        $this->dataTypeHelper = App::make(DataTypeHelper::class);
        $this->storage = App::make(Storage::class);
        
    }




}