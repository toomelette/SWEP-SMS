<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\DepartmentInterface;


use App\Models\Department;


class DepartmentRepository extends BaseRepository implements DepartmentInterface {
	



    protected $department;




	public function __construct(Department $department){

        $this->department = $department;
        parent::__construct();

    }






    public function fetch($request){

        $key = str_slug($request->fullUrl(), '_');

        $departments = $this->cache->remember('departments:fetch:' . $key, 240, function() use ($request){

            $department = $this->department->newQuery();
            
            if(isset($request->q)){
                $this->search($department, $request->q);
            }

            return $this->populate($department);

        });

        return $departments;

    }






    public function store($request){

        $department = new Department;
        $department->slug = $this->str->random(16);
        $department->department_id = $this->getDepartmentIdInc();
        $department->name = $request->name;
        $department->created_at = $this->carbon->now();
        $department->updated_at = $this->carbon->now();
        $department->ip_created = request()->ip();
        $department->ip_updated = request()->ip();
        $department->user_created = $this->auth->user()->user_id;
        $department->user_updated = $this->auth->user()->user_id;
        $department->save();

        return $department;

    }






    public function update($request, $slug){

        $department = $this->findBySlug($slug);
        $department->name = $request->name;
        $department->updated_at = $this->carbon->now();
        $department->ip_updated = request()->ip();
        $department->user_updated = $this->auth->user()->user_id;
        $department->save();

        return $department;

    }






    public function destroy($slug){

        $department = $this->findBySlug($slug);
        $department->delete();

        return $department;

    }






    public function findBySlug($slug){

        $department = $this->cache->remember('departments:findBySlug:' . $slug, 240, function() use ($slug){
            return $this->department->where('slug', $slug)->first();
        });

        if(empty($department)){
            abort(404);
        }
        
        return $department;

    }






    public function findByDepartmentId($dept_id){

        $department = $this->cache->remember('departments:findByDepartmentId:' . $dept_id, 240, function() use ($dept_id){
            return $this->department->where('department_id', $dept_id)->first();
        });

        if(empty($department)){
            abort(404);
        }
        
        return $department;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('name', 'LIKE', '%'. $key .'%');
        });

    }






    public function populate($model){

        return $model->select('name', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }






    public function getDepartmentIdInc(){

        $id = 'D1001';

        $department = $this->department->select('department_id')->orderBy('department_id', 'desc')->first();

        if($department != null){
            
            if($department->department_id != null){
                $num = str_replace('D', '', $department->department_id) + 1;
                $id = 'D' . $num;
            }
        
        }
        
        return $id;
        
    }






    public function getAll(){

        $departments = $this->cache->remember('departments:getAll', 240, function(){
            return $this->department->select('name', 'department_id')->get();
        });
        
        return $departments;

    }






    public function getByDepartmentId($dept_id){

        $department_name = $this->cache->remember('departments:getByDepartmentId:'. $dept_id .'', 240, function() use ($dept_id){

            return $this->department->select('name')
                                    ->where('department_id', $dept_id)
                                    ->get();
                                    
        });
        
        return $department_name;

    }







}