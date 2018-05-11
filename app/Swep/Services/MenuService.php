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





    public function fetchAll(Request $request){

        $key = str_slug($request->fullUrl(), '_');

        $menus = $this->cache->remember('menu:all:' . $key, 240, function() use ($request){

            $menu = $this->menu->newQuery();
            
            if($request->q != null){
                $menu->search($request->q);
            }

            return $menu->populate();

        });

        $request->flash();
        
        return view('dashboard.menu.index')->with('menus', $menus);

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





    public function edit($slug){

        $menu = $this->cache->remember('menu:bySlug:' . $slug, 240, function() use ($slug){
            return $this->menu->findSlug($slug);
        }); 

        return view('dashboard.menu.edit')->with('menu', $menu);

    }





    public function update(Request $request, $slug){

        $menu = $this->cache->remember('menu:bySlug:' . $slug, 240, function() use ($slug){
            return $this->menu->findSlug($slug);
        }); 

        $menu->name = $request->name;
        $menu->route = $request->route;
        $menu->icon = $request->icon;
        $menu->is_menu = DataTypeHelper::boolean($request->is_menu);
        $menu->is_dropdown = DataTypeHelper::boolean($request->is_dropdown);
        $menu->save();

        $this->event->fire('menu.update', [$menu, $request]);

        $this->session->flash('MENU_UPDATE_SUCCESS', 'The Menu has been successfully updated!');
        $this->session->flash('MENU_UPDATE_SUCCESS_SLUG', $menu->slug);

        return redirect()->route('dashboard.menu.index');

    }




    public function destroy($slug){

        $menu = $this->cache->remember('menu:bySlug:' . $slug, 240, function() use ($slug){
            return $this->menu->findSlug($slug);
        }); 

        $menu->delete();
        $menu->submenu()->delete();
        
        $this->event->fire('menu.delete', $menu);
        $this->session->flash('MENU_DELETE_SUCCESS', 'The Menu has been successfully deleted!');
        $this->session->flash('MENU_DELETE_SUCCESS_SLUG', $menu->slug);
        return redirect()->route('dashboard.menu.index');

    }




}