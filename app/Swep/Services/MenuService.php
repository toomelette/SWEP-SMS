<?php
 
namespace App\Swep\Services;


use App\Models\Menu;
use App\Swep\BaseClasses\BaseService;


class MenuService extends BaseService{



	protected $menu;



    public function __construct(Menu $menu){

        $this->menu = $menu;
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

        $menu = $this->menu->create($request->except(['is_menu', 'is_dropdown']));
        $this->event->fire('menu.create', [$menu, $request]);
        $this->session->flash('MENU_CREATE_SUCCESS', 'The Menu has been successfully created!');
        return redirect()->back();

    }






    public function edit($slug){

        $menu = $this->menuBySlug($slug);
        return view('dashboard.menu.edit')->with('menu', $menu);

    }






    public function update($request, $slug){

        $menu = $this->menuBySlug($slug);
        $menu->update($request->except(['is_menu', 'is_dropdown']));
        $this->event->fire('menu.update', [$menu, $request]);
        $this->session->flash('MENU_UPDATE_SUCCESS', 'The Menu has been successfully updated!');
        $this->session->flash('MENU_UPDATE_SUCCESS_SLUG', $menu->slug);
        return redirect()->route('dashboard.menu.index');

    }






    public function destroy($slug){

        $menu = $this->menuBySlug($slug);
        $menu->delete();
        $menu->submenu()->delete();
        $this->event->fire('menu.delete', $menu);
        $this->session->flash('MENU_DELETE_SUCCESS', 'The Menu has been successfully deleted!');
        $this->session->flash('MENU_DELETE_SUCCESS_SLUG', $menu->slug);
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