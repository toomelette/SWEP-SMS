<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\PlantillaInterface;


use App\Models\Plantilla;


class PlantillaRepository extends BaseRepository implements PlantillaInterface {
	



    protected $plantilla;




	public function __construct(Plantilla $plantilla){

        $this->plantilla = $plantilla;
        parent::__construct();

    }





    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $plantillas = $this->cache->remember('plantillas:fetch:' . $key, 240, function() use ($request){

            $plantilla = $this->plantilla->newQuery();
            
            if(isset($request->q)){
                $this->search($plantilla, $request->q);
            }

            if (isset($request->du)) {
                $plantilla->whereDepartmentUnitId($request->du);
            }

            return $this->populate($plantilla);

        });

        return $plantillas;

    }







    public function store($request){

        $plantilla = new Plantilla;
        $plantilla->slug = $this->str->random(16);
        $plantilla->plantilla_id = $this->getPlantillaIdInc();
        $plantilla->department_unit_id = $request->department_unit_id;
        $plantilla->name = $request->name;
        $plantilla->is_vacant = $this->__dataType->string_to_boolean($request->is_vacant);
        $plantilla->created_at = $this->carbon->now();
        $plantilla->updated_at = $this->carbon->now();
        $plantilla->ip_created = request()->ip();
        $plantilla->ip_updated = request()->ip();
        $plantilla->user_created = $this->auth->user()->user_id;
        $plantilla->user_updated = $this->auth->user()->user_id;
        $plantilla->save();

        return $plantilla;

    }






    public function update($request, $slug){

        $plantilla = $this->findBySlug($slug);
        $plantilla->department_unit_id = $request->department_unit_id;
        $plantilla->name = $request->name;
        $plantilla->is_vacant = $this->__dataType->string_to_boolean($request->is_vacant);
        $plantilla->created_at = $this->carbon->now();
        $plantilla->ip_created = request()->ip();
        $plantilla->user_created = $this->auth->user()->user_id;
        $plantilla->save();

        return $plantilla;

    }






    public function destroy($slug){

        $plantilla = $this->findBySlug($slug);
        $plantilla->delete();

        return $plantilla;

    }






    public function findBySlug($slug){

        $plantilla = $this->cache->remember('plantillas:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->plantilla->where('slug', $slug)->first();
        });

        if(empty($plantilla)){
            abort(404);
        }
        
        return $plantilla;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('name', 'LIKE', '%'. $key .'%');
        });

    }






    public function populate($model){

        return $model->select('department_unit_id', 'name', 'is_vacant', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }






    public function getPlantillaIdInc(){

        $id = 'P10001';

        $plantilla = $this->plantilla->select('plantilla_id')->orderBy('plantilla_id', 'desc')->first();

        if($plantilla != null){
            
            if($plantilla->plantilla_id != null){
                $num = str_replace('P', '', $plantilla->plantilla_id) + 1;
                $id = 'P' . $num;
            }
        
        }
        
        return $id;
        
    }






    public function getAll(){

        $plantilla = $this->cache->remember('plantillas:getAll', 240, function(){
            return $this->plantilla->select('plantilla_id', 'name')->get();
        });
        
        return $plantilla;

    }






}