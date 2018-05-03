<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Swep\Services\MenuService;
use App\Http\Requests\MenuFormRequest;



class MenuController extends Controller{


    protected $menu;



    public function __construct(MenuService $menu){

        $this->menu = $menu;

    }


    
    public function index(Request $request){
        
        return $this->menu->fetchAll($request);

    }

    

    public function create(){
        
        return view('dashboard.menu.create');

    }

   

    public function store(MenuFormRequest $request){
        
        return $this->menu->store($request);

    }

   



    public function show($slug){
        


    }

    



    public function edit($slug){
        


    }




    public function update(Request $request, $slug){
        


    }

    


    public function destroy($slug){
        


    }
}
