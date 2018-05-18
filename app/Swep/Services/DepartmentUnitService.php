<?php
 
namespace App\Swep\Services;


use App\Models\DepartmentUnit;
use App\Swep\BaseClasses\BaseService;



class DepartmentUnitService extends BaseService{



	protected $department_unit;



    public function __construct(DepartmentUnit $department_unit){

        $this->department_unit = $department_unit;
        parent::__construct();

    }





    public function fetchAll($request){

       $key = str_slug($request->fullUrl(), '_');

        $department_units = $this->cache->remember('department_units:all:' . $key, 240, function() use ($request){

            $department_unit = $this->department_unit->newQuery();
            
            if($request->q != null){
                $department_unit->search($request->q);
            }

            return $department_unit->populate();

        });

        $request->flash();
        
        return view('dashboard.department_unit.index')->with('department_units', $department_units);

    }






    public function store($request){

        $department_unit = new DepartmentUnit;
        $department_unit->slug = $this->str->random(16);
        $department_unit->department_Unit_id = $this->department_unit->departmentUnitIdInc;
        $department_unit->department_id = $request->department_id;
        $department_unit->department_name = $request->department_name;
        $department_unit->name = $request->name;
        $department_unit->description = $request->description;
        $department_unit->created_at = $this->carbon->now();
        $department_unit->updated_at = $this->carbon->now();
        $department_unit->ip_created = request()->ip();
        $department_unit->ip_updated = request()->ip();
        $department_unit->user_created = $this->auth->user()->username;
        $department_unit->user_updated = $this->auth->user()->username;
        $department_unit->save();

        $this->event->fire('department_unit.store');        
        return redirect()->back();

    }






    public function edit($slug){

        $department_unit = $this->departmentUnitsBySlug($slug);
        return view('dashboard.department_unit.edit')->with('department_unit', $department_unit);

    }






    public function update($request, $slug){

        $department_unit = $this->departmentUnitsBySlug($slug);
        $department_unit->department_id = $request->department_id;
        $department_unit->department_name = $request->department_name;
        $department_unit->name = $request->name;
        $department_unit->description = $request->description;
        $department_unit->updated_at = $this->carbon->now();
        $department_unit->ip_updated = request()->ip();
        $department_unit->user_updated = $this->auth->user()->username;
        $department_unit->save();
        
        $this->event->fire('department_unit.update', $department_unit);
        return redirect()->route('dashboard.department_unit.index');

    }






    public function destroy($slug){

        $department_unit = $this->departmentUnitsBySlug($slug);
        $department_unit->delete();
        
        $this->event->fire('department_unit.destroy', $department_unit);
        return redirect()->route('dashboard.department_unit.index');

    }





    // Utility Methods

    public function departmentUnitsBySlug($slug){

        $department_unit = $this->cache->remember('department_units:bySlug:' . $slug, 240, function() use ($slug){
            return $this->department_unit->findSlug($slug);
        });
        
        return $department_unit;

    }





}