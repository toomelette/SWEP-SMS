<?php
 
namespace App\Swep\Services;


use App\Models\Submenu;
use App\Swep\BaseClasses\BaseService;



class SubmenuService extends BaseService{



	protected $submenu;



    public function __construct(Submenu $submenu){

        $this->submenu = $submenu;
        parent::__construct();

    }





    public function fetchAll($request){

       $key = str_slug($request->fullUrl(), '_');

        $submenus = $this->cache->remember('submenus:all:' . $key, 240, function() use ($request){

            $submenu = $this->submenu->newQuery();
            
            if($request->q != null){
                $submenu->search($request->q);
            }

            return $submenu->populate();

        });

        $request->flash();
        
        return view('dashboard.submenu.index')->with('submenus', $submenus);

    }






    public function edit($slug){

        $submenu = $this->submenuBySlug($slug);
        return view('dashboard.submenu.edit')->with('submenu', $submenu);

    }






    public function update($request, $slug){

        $submenu = $this->submenuBySlug($slug);
        $submenu->name = $request->name;
        $submenu->route = $request->route;
        $submenu->is_nav = $this->dataTypeHelper->string_to_boolean($request->is_nav);
        $submenu->updated_at = $this->carbon->now();
        $submenu->ip_updated = request()->ip();
        $submenu->user_updated = $this->auth->user()->user_id;
        $submenu->save();

        $this->event->fire('submenu.update', $submenu);
        return redirect()->route('dashboard.submenu.index');

    }






    public function destroy($slug){

        $submenu = $this->submenuBySlug($slug);
        $submenu->delete();

        $this->event->fire('submenu.destroy',$submenu);
        return redirect()->route('dashboard.submenu.index');

    }





    // Utility Methods

    public function submenuBySlug($slug){

        $submenu = $this->cache->remember('submenus:bySlug:' . $slug, 240, function() use ($slug){
            return $this->submenu->findSlug($slug);
        });
        
        return $submenu;

    }





}