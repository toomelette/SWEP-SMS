<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Swep\Services\MenuService;



class MenuController extends Controller{


    protected $menu;



    public function __construct(MenuService $menu){

        $this->menu = $menu;

    }


    
    public function index(){
        


    }

    

    public function create(){
        
        return view('dashboard.menu.create');

    }

   

    public function store(Request $request){
        
        return $this->menu->store($request);

    }

   



    public function show($id){
        


    }

    



    public function edit($id){
        


    }




    public function update(Request $request, $id){
        


    }

    


    public function destroy($id){
        


    }
}
