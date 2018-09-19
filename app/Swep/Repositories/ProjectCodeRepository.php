<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\ProjectCodeInterface;


use App\Models\ProjectCode;


class ProjectCodeRepository extends BaseRepository implements ProjectCodeInterface {
	



    protected $project_code;




	public function __construct(ProjectCode $project_code){

        $this->project_code = $project_code;
        parent::__construct();

    }





    public function fetchAll($request){

        $key = str_slug($request->fullUrl(), '_');

        $project_codes = $this->cache->remember('project_codes:all:' . $key, 240, function() use ($request){

            $project_code = $this->project_code->newQuery();
            
            if(isset($request->q)){
                $this->search($project_code, $request->q);
            }

            return $this->populate($project_code);

        });
        
        return $project_codes;

    }






    public function store($request){

        $project_code = new ProjectCode;
        $project_code->slug = $this->str->random(16);
        $project_code->project_code_id = $this->getProjectCodeIdInc();
        $project_code->department_id = $request->department_id;
        $project_code->department_name = $request->department_name;
        $project_code->project_code = $request->project_code;
        $project_code->description = $request->description;
        $project_code->mooe = $this->__dataType->string_to_num($request->mooe);
        $project_code->co = $this->__dataType->string_to_num($request->co);
        $project_code->date_started = $this->__dataType->date_parse($request->date_started, 'Y-m-d');
        $project_code->projected_date_end = $this->__dataType->date_parse($request->projected_date_end, 'Y-m-d');
        $project_code->project_in_charge = $request->project_in_charge;
        $project_code->created_at = $this->carbon->now();
        $project_code->updated_at = $this->carbon->now();
        $project_code->ip_created = request()->ip();
        $project_code->ip_updated = request()->ip();
        $project_code->user_created = $this->auth->user()->user_id;
        $project_code->user_updated = $this->auth->user()->user_id;
        $project_code->save();

        return $project_code;

    }






    public function update($request, $slug){

        $project_code = $this->findBySlug($slug);
        $project_code->department_id = $request->department_id;
        $project_code->department_name = $request->department_name;
        $project_code->project_code = $request->project_code;
        $project_code->description = $request->description;
        $project_code->mooe = $this->__dataType->string_to_num($request->mooe);
        $project_code->co = $this->__dataType->string_to_num($request->co);
        $project_code->date_started = $this->__dataType->date_parse($request->date_started, 'Y-m-d');
        $project_code->projected_date_end = $this->__dataType->date_parse($request->projected_date_end, 'Y-m-d');
        $project_code->project_in_charge = $request->project_in_charge;
        $project_code->updated_at = $this->carbon->now();
        $project_code->ip_updated = request()->ip();
        $project_code->user_updated = $this->auth->user()->user_id;
        $project_code->save();

        return $project_code;

    }






    public function destroy($slug){

        $project_code = $this->findBySlug($slug);
        $project_code->delete();
        
        return $project_code;

    }






    public function findBySlug($slug){

        $project_code = $this->cache->remember('project_codes:bySlug:' . $slug, 240, function() use ($slug){
            return $this->project_code->where('slug', $slug)->first();
        });
        
        if(empty($project_code)){
            abort(404);
        }
        
        return $project_code;

    }






    public function populate($model){

        return $model->select('project_code', 'department_name', 'description', 'project_in_charge', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('department_name', 'LIKE', '%'. $key .'%')
                      ->orwhere('project_code', 'LIKE', '%'. $key .'%')
                      ->orwhere('description', 'LIKE', '%'. $key .'%')
                      ->orwhere('project_in_charge', 'LIKE', '%'. $key .'%');
        });

    }






    public function getProjectCodeIdInc(){

        $id = 'A1001';

        $project_code = $this->project_code->select('project_code_id')->orderBy('project_code_id', 'desc')->first();

        if($project_code != null){

            if($project_code->project_code_id != null){
                $num = str_replace('A', '', $project_code->project_code_id) + 1;
                $id = 'A' . $num;
            }
            
        }
        
        return $id;
        
    }






    public function globalFetchAll(){

        $project_codes = $this->cache->remember('project_codes:global:all', 240, function(){
            return $this->project_code->select('project_code')->get();
        });
        
        return $project_codes;

    }






    public function apiGetByDepartmentName($dept_name){

        $project_code = $this->cache->remember('api:project_codes:byDepartmentName:'. $dept_name .'', 240, function() use ($dept_name){
                
            return $this->project_code->select('project_code')
                                 ->where('department_name', $dept_name)
                                 ->get();

        });
        
        return $project_code;

    }






}