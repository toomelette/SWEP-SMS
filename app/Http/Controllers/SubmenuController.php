<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Swep\Services\SubmenuService;


class SubmenuController extends Controller{
    

	protected $submenu;



    public function __construct(SubmenuService $submenu){

        $this->submenu = $submenu;

    }



    
    public function index(Request $request){

        return $this->submenu->fetchAll($request);
    
    }





    public function edit($slug){

        return $this->submenu->edit($slug);
        
    }




    public function update(Request $request, $slug){

        return $this->submenu->update($request, $slug);

    }

    


    public function destroy($slug){

       return $this->submenu->destroy($slug); 

    }




}
