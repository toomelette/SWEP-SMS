<?php
 
namespace App\Swep\Services;


use App\Models\Department;
use App\Swep\BaseClasses\BaseService;



class DepartmentService extends BaseService{



	protected $department;



    public function __construct(Department $department){

        $this->department = $department;
        parent::__construct();

    }





    public function fetchAll($request){

       $key = str_slug($request->fullUrl(), '_');

        $departments = $this->cache->remember('departments:all:' . $key, 240, function() use ($request){

            $department = $this->department->newQuery();
            
            if($request->q != null){
                $department->search($request->q);
            }

            return $department->populate();

        });

        $request->flash();
        return view('dashboard.department.index')->with('departments', $departments);

    }






    public function store($request){

        $department = new Department;
        $department->slug = $this->str->random(16);
        $department->department_id = $this->department->departmentIdInc;
        $department->name = $request->name;
        $department->created_at = $this->carbon->now();
        $department->updated_at = $this->carbon->now();
        $department->ip_created = request()->ip();
        $department->ip_updated = request()->ip();
        $department->user_created = $this->auth->user()->user_id;
        $department->user_updated = $this->auth->user()->user_id;
        $department->save();

        $this->event->fire('department.store');
        return redirect()->back();

    }





    public function edit($slug){

        $department = $this->departmentsBySlug($slug);
        return view('dashboard.department.edit')->with('department', $department);

    }





    public function update($request, $slug){

        $department = $this->departmentsBySlug($slug);
        $department->name = $request->name;
        $department->updated_at = $this->carbon->now();
        $department->ip_updated = request()->ip();
        $department->user_updated = $this->auth->user()->user_id;
        $department->save();

        $this->event->fire('department.update', $department);
        return redirect()->route('dashboard.department.index');

    }





    public function destroy($slug){

        $department = $this->departmentsBySlug($slug);
        $department->delete();

        $this->event->fire('department.destroy', $department );
        return redirect()->route('dashboard.department.index');

    }





    // Utility Methods

    public function departmentsBySlug($slug){

        $department = $this->cache->remember('departments:bySlug:' . $slug, 240, function() use ($slug){
            return $this->department->findSlug($slug);
        });
        
        return $department;

    }




}