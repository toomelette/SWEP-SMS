<?php
 
namespace App\Swep\Services;


use App\Swep\Interfaces\PlantillaInterface;
use App\Swep\BaseClasses\BaseService;



class PlantillaService extends BaseService{



    protected $plantilla_repo;



    public function __construct(PlantillaInterface $plantilla_repo){

        $this->plantilla_repo = $plantilla_repo;
        parent::__construct();

    }





    public function fetch($request){

        $plantillas = $this->plantilla_repo->fetch($request);

        $request->flash();
        return view('dashboard.plantilla.index')->with('plantillas', $plantillas);

    }






    public function store($request){

        $plantilla = $this->plantilla_repo->store($request);

        $this->event->dispatch('plantilla.store');
        return redirect()->back();

    }





    public function edit($slug){

        $plantilla = $this->plantilla_repo->findBySlug($slug);
        return view('dashboard.plantilla.edit')->with('plantilla', $plantilla);

    }





    public function update($request, $slug){

        $plantilla = $this->plantilla_repo->update($request, $slug);

        $this->event->dispatch('plantilla.update', $plantilla);
        return redirect()->route('dashboard.plantilla.index');

    }





    public function destroy($slug){

        $plantilla = $this->plantilla_repo->destroy($slug);

        $this->event->dispatch('plantilla.destroy', $plantilla );
        return redirect()->back();

    }







}