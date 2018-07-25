<?php
 
namespace App\Swep\BaseClasses;


use App;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Swep\Helpers\DataTypeHelper;
use Illuminate\Cache\Repository as Cache;


class BaseRepository{



    protected $auth;
    protected $carbon;
    protected $str;
    protected $event;
    protected $dataTypeHelper;
    protected $cache;



    public function __construct(){
        
        $this->auth = auth();
        $this->carbon = App::make(Carbon::class);
        $this->str = App::make(Str::class);
        $this->dataTypeHelper = App::make(DataTypeHelper::class);
        $this->cache = App::make(Cache::class);
        
    }




}