<?php

namespace App\Http\Controllers;


use App\Models\DepartmentTree;
use App\Models\HRPayPlanitilla;
use App\Node;
use App\Swep\Services\PlantillaService;
use App\Http\Requests\Plantilla\PlantillaFormRequest;
use App\Http\Requests\Plantilla\PlantillaFilterRequest;



class PlantillaController extends Controller{



	protected $plantilla;



    public function __construct(PlantillaService $plantilla){

        $this->plantilla = $plantilla;

    }



    
    public function index(PlantillaFilterRequest $request){

        return $this->plantilla->fetch($request);
    
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

    public function print(){

        
        $pls = HRPayPlanitilla::query()
            ->orderBy('control_no','asc')
            ->orderBy('department_header','asc')
            ->orderBy('division_header','asc')
            ->orderBy('section_header','asc')
            ->orderBy('item_no','asc')
            ->get();
        $plsArr = [];
        foreach ($pls as $pl){
            if($pl->section == 'NONE' && $pl->division== 'NONE'){
                $plsArr[$pl->department][$pl->item_no]= $pl;
            }elseif($pl->division != 'NONE' && $pl->section == 'NONE'){
                $plsArr[$pl->department][$pl->division][$pl->item_no] = $pl;
            }else{
                $plsArr[$pl->department][$pl->division][$pl->section][$pl->item_no] = $pl;
            }

        }
//        dd($plsArr) ;
        return view('printables.plantilla.print')->with([
            'pls' => $plsArr,
        ]);
    }


    
}
