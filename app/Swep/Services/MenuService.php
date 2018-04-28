<?php
 
namespace App\Swep\Services;

use Auth;
use Session;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Events\Dispatcher;
use Illuminate\Cache\Repository as Cache;

class MenuService{


	protected $menu;
    protected $event;
    protected $cache;
    protected $auth;
    protected $session;



    public function __construct(Menu $menu, Dispatcher $event, Cache $cache){

        $this->menu = $menu;
        $this->event = $event;
        $this->cache = $cache;
        $this->auth = auth();
        $this->session = session();

    }




    public function store(Request $request){

        dd($request);

    }






}