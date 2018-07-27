<?php
 
namespace App\Swep\Services;


use App\Swep\Interfaces\MenuInterface;
use App\Swep\Interfaces\SubmenuInterface;
use App\Swep\BaseClasses\BaseService;


class MenuService extends BaseService{


    protected $menu_repo;
    protected $submenu_repo;



    public function __construct(MenuInterface $menu_repo, SubmenuInterface $submenu_repo){

        $this->menu_repo = $menu_repo;
        $this->submenu_repo = $submenu_repo;
        parent::__construct();

    }





    public function fetchAll($request){

        $menus = $this->menu_repo->fetchAll($request);

        $request->flash();
        return view('dashboard.menu.index')->with('menus', $menus);

    }






    public function store($request){
       
        $rows = $request->row;

        $menu = $this->menu_repo->store($request);

        if(count($rows) > 0){

            foreach ($rows as $row) {
                
                $submenu = $this->submenu_repo->store($row, $menu);

            }
        }
        
        $this->event->fire('menu.store');
        return redirect()->back();

    }






    public function edit($slug){

        $menu = $this->menu_repo->findbySlug($slug);
        return view('dashboard.menu.edit')->with('menu', $menu);

    }






    public function update($request, $slug){

        $menu = $this->menu_repo->update($request, $slug);

        $this->event->fire('menu.update', $menu);
        return redirect()->route('dashboard.menu.index');

    }






    public function destroy($slug){

        $menu = $this->menu_repo->destroy($slug);

        $this->event->fire('menu.destroy', $menu);
        return redirect()->route('dashboard.menu.index');

    }






}