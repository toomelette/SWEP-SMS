<?php

namespace App\Http\Controllers;


use App\Swep\Services\PlantillaService;
use App\Http\Requests\Plantilla\PlantillaFormRequest;
use App\Http\Requests\Plantilla\PlantillaFilterRequest;



class PlantillaController extends Controller{



	protected $plantilla;



    public function __construct(PlantillaService $plantilla){

        $this->plantilla = $plantilla;

    }



    
    public function index(PlantillaFilterRequest $request){

        return $this->plantilla->fetchAll($request);
    
    }

    


    public function create(){

        return view('dashboard.plantilla.create');

    }

    


    public function store(PlantillaFormRequest $request){

        return $this->plantilla->store($request);
        
    }




    public function edit($slug){

        return $this->plantilla->edit($slug);
        
    }




    public function update(PlantillaFormRequest $request, $slug){

        return $this->plantilla->update($request, $slug);

    }

    


    public function destroy($slug){

       return $this->plantilla->destroy($slug); 

    }



    
}
