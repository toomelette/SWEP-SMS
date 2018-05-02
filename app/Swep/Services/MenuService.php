<?php
 
namespace App\Swep\Services;

use Auth;
use Session;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Events\Dispatcher;
use Illuminate\Cache\Repository as Cache;
use App\Swep\Helpers\DataTypeHelper;

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

        $menu = new Menu;
        $menu->name = $request->name;
        $menu->route = $request->route;
        $menu->icon = $request->icon;
        $menu->is_menu = DataTypeHelper::boolean($request->is_menu);
        $menu->is_dropdown = DataTypeHelper::boolean($request->is_dropdown);
        $menu->save();

        $this->event->fire('menu.create', [$menu, $request]);

        $this->session->flash('MENU_CREATE_SUCCESS', 'The Menu has been successfully created!');
        
        return redirect()->back();

    }






}