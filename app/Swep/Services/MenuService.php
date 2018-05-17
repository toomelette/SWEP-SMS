<?php
 
namespace App\Swep\Services;


use App\Models\Menu;
use App\Models\Submenu;
use App\Swep\BaseClasses\BaseService;


class MenuService extends BaseService{



	protected $menu;
    protected $submenu;



    public function __construct(Menu $menu, Submenu $submenu){

        $this->menu = $menu;
        $this->submenu = $submenu;
        parent::__construct();

    }





    public function fetchAll($request){

        $key = str_slug($request->fullUrl(), '_');

        $menus = $this->cache->remember('menus:all:' . $key, 240, function() use ($request){

            $menu = $this->menu->newQuery();
            
            if($request->q != null){
                $menu->search($request->q);
            }

            return $menu->populate();

        });

        $request->flash();
        
        return view('dashboard.menu.index')->with('menus', $menus);

    }






    public function store($request){
       
        $rows = $request->row;

        $menu = new Menu;
        $menu->menu_id = $this->menu->menuIdIncrement;
        $menu->slug = $this->str->random(16);
        $menu->name = $request->name;
        $menu->route = $request->route;
        $menu->icon = $request->icon;
        $menu->is_menu = $this->dataTypeHelper->string_to_boolean($request->is_menu);
        $menu->is_dropdown = $this->dataTypeHelper->string_to_boolean($request->is_dropdown);
        $menu->created_at = $this->carbon->now();
        $menu->updated_at = $this->carbon->now();
        $menu->ip_created = request()->ip();
        $menu->ip_updated = request()->ip();
        $menu->user_created = $this->auth->user()->username;
        $menu->user_updated = $this->auth->user()->username;
        $menu->save();

        if(count($rows) > 0){

            foreach ($rows as $row) {
                
                $submenu = new Submenu;
                $submenu->slug = $this->str->random(16);
                $submenu->submenu_id = $this->submenu->submenuIdIncrement;
                $submenu->menu_id = $menu->menu_id;
                $submenu->name = $row['sub_name'];
                $submenu->route = $row['sub_route'];
                $submenu->is_nav = $this->dataTypeHelper->string_to_boolean($row['sub_is_nav']);  
                $submenu->created_at = $this->carbon->now();
                $submenu->updated_at = $this->carbon->now();
                $submenu->ip_created = request()->ip();
                $submenu->ip_updated = request()->ip();
                $submenu->user_created = $this->auth->user()->username;
                $submenu->user_updated = $this->auth->user()->username;
                $submenu->save();

            }
        }
        
        $this->event->fire('menu.store');
        return redirect()->back();

    }






    public function edit($slug){

        $menu = $this->menuBySlug($slug);
        return view('dashboard.menu.edit')->with('menu', $menu);

    }






    public function update($request, $slug){

        $menu = $this->menuBySlug($slug);
        $menu->name = $request->name;
        $menu->route = $request->route;
        $menu->icon = $request->icon;
        $menu->is_menu = $this->dataTypeHelper->string_to_boolean($request->is_menu);
        $menu->is_dropdown = $this->dataTypeHelper->string_to_boolean($request->is_dropdown);
        $menu->updated_at = $this->carbon->now();
        $menu->ip_updated = request()->ip();
        $menu->user_updated = $this->auth->user()->username;
        $menu->save();

        $this->event->fire('menu.update', $menu);
        return redirect()->route('dashboard.menu.index');

    }






    public function destroy($slug){

        $menu = $this->menuBySlug($slug);
        $menu->delete();
        $menu->submenu()->delete();

        $this->event->fire('menu.destroy', $menu);
        return redirect()->route('dashboard.menu.index');

    }





    // Utility Methods

    public function menuBySlug($slug){

        $menu = $this->cache->remember('menus:bySlug:' . $slug, 240, function() use ($slug){
            return $this->menu->findSlug($slug);
        }); 
        
        return $menu;

    }





}