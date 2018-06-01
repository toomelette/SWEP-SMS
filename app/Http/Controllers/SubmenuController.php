<?php

namespace App\Http\Controllers;


use App\Swep\Services\SubmenuService;
use App\Http\Requests\SubmenuFormRequest;
use App\Http\Requests\SubmenuFilterRequest;


class SubmenuController extends Controller{
    

	protected $submenu;



    public function __construct(SubmenuService $submenu){

        $this->submenu = $submenu;

    }



    
    public function index(SubmenuFilterRequest $request){

        return $this->submenu->fetchAll($request);
    
    }





    public function edit($slug){

        return $this->submenu->edit($slug);
        
    }




    public function update(SubmenuFormRequest $request, $slug){

        return $this->submenu->update($request, $slug);

    }

    


    public function destroy($slug){

       return $this->submenu->destroy($slug); 

    }




}
