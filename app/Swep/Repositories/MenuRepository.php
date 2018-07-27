<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\MenuInterface;

use App\Models\Menu;


class MenuRepository extends BaseRepository implements MenuInterface {
	


    protected $menu;



	public function __construct(Menu $menu){

        $this->menu = $menu;
        parent::__construct();

    }





    public function fetchAll($request){

        $key = str_slug($request->fullUrl(), '_');

        $menus = $this->cache->remember('menus:all:' . $key, 240, function() use ($request){

            $menu = $this->menu->newQuery();
            
            if(isset($request->q)){
                $this->search($menu, $request->q);
            }

            return $this->populate($menu);

        });

        return $menus;

    }





    public function store($request){

        $menu = new Menu;
        $menu->menu_id = $this->getMenuIdInc();
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
        $menu->user_created = $this->auth->user()->user_id;
        $menu->user_updated = $this->auth->user()->user_id;
        $menu->save();
        
        return $menu;

    }





    public function update($request, $slug){

        $menu = $this->findBySlug($slug);
        $menu->name = $request->name;
        $menu->route = $request->route;
        $menu->icon = $request->icon;
        $menu->is_menu = $this->dataTypeHelper->string_to_boolean($request->is_menu);
        $menu->is_dropdown = $this->dataTypeHelper->string_to_boolean($request->is_dropdown);
        $menu->updated_at = $this->carbon->now();
        $menu->ip_updated = request()->ip();
        $menu->user_updated = $this->auth->user()->user_id;
        $menu->save();

        return $menu;

    }





    public function destroy($slug){

        $menu = $this->findBySlug($slug);
        $menu->delete();
        $menu->submenu()->delete();

        return $menu;

    }





    public function findBySlug($slug){

        $menu = $this->cache->remember('menus:bySlug:' . $slug, 240, function() use ($slug){
            return $this->menu->where('slug', $slug)->first();
        }); 
        
        return $menu;

    }






    public function findByMenuId($menu_id){

        $menu = $this->cache->remember('menus:byMenuId:' . $menu_id, 240, function() use ($menu_id){
            return $this->menu->where('menu_id', $menu_id)->first();
        });
        
        return $menu;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('name', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model){

        return $model->select('name', 'route', 'icon', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }






    public function getMenuIdInc(){

        $id = 'M10001';

        $menu = $this->menu->select('menu_id')->orderBy('menu_id', 'desc')->first();

        if($menu != null){

            if($menu->menu_id != null){
                $num = str_replace('M', '', $menu->menu_id) + 1;
                $id = 'M' . $num;
            }
        
        }
        
        return $id;
        
    }






}