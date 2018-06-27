<?php
 
namespace App\Swep\Services;


use App\Models\ProjectCode;
use App\Swep\BaseClasses\BaseService;


class ProjectCodeService extends BaseService{



	protected $project_code;



    public function __construct(ProjectCode $project_code){

        $this->project_code = $project_code;
        parent::__construct();

    }





    public function fetchAll($request){

        $key = str_slug($request->fullUrl(), '_');

        $project_codes = $this->cache->remember('project_codes:all:' . $key, 240, function() use ($request){

            $project_code = $this->project_code->newQuery();
            
            if($request->q != null){
                $project_code->search($request->q);
            }

            return $project_code->populate();

        });
        
        $request->flash();
        return view('dashboard.project_code.index')->with('project_codes', $project_codes);

    }






    public function store($request){

        $project_code = new ProjectCode;
        $project_code->slug = $this->str->random(16);
        $project_code->project_code_id = $this->project_code->projectCodeIdInc;
        $project_code->department_id = $request->department_id;
        $project_code->department_name = $request->department_name;
        $project_code->project_code = $request->project_code;
        $project_code->description = $request->description;
        $project_code->mooe = $this->dataTypeHelper->string_to_num($request->mooe);
        $project_code->co = $this->dataTypeHelper->string_to_num($request->co);
        $project_code->date_started = $this->dataTypeHelper->date_in($request->date_started);
        $project_code->projected_date_end = $this->dataTypeHelper->date_in($request->projected_date_end);
        $project_code->project_in_charge = $request->project_in_charge;
        $project_code->created_at = $this->carbon->now();
        $project_code->updated_at = $this->carbon->now();
        $project_code->ip_created = request()->ip();
        $project_code->ip_updated = request()->ip();
        $project_code->user_created = $this->auth->user()->user_id;
        $project_code->user_updated = $this->auth->user()->user_id;
        $project_code->save();

        $this->event->fire('project_code.store');
        return redirect()->back();

    }






    public function edit($slug){

        $project_code = $this->projectCodeBySlug($slug);
        return view('dashboard.project_code.edit')->with('project_code', $project_code);

    }






    public function update($request, $slug){

        $project_code = $this->projectCodeBySlug($slug);
        $project_code->department_id = $request->department_id;
        $project_code->department_name = $request->department_name;
        $project_code->project_code = $request->project_code;
        $project_code->description = $request->description;
        $project_code->mooe = $this->dataTypeHelper->string_to_num($request->mooe);
        $project_code->co = $this->dataTypeHelper->string_to_num($request->co);
        $project_code->date_started = $this->dataTypeHelper->date_in($request->date_started);
        $project_code->projected_date_end = $this->dataTypeHelper->date_in($request->projected_date_end);
        $project_code->project_in_charge = $request->project_in_charge;
        $project_code->updated_at = $this->carbon->now();
        $project_code->ip_updated = request()->ip();
        $project_code->user_updated = $this->auth->user()->user_id;
        $project_code->save();

        $this->event->fire('project_code.update', $project_code);
        return redirect()->route('dashboard.project_code.index');

    }






    public function destroy($slug){

        $project_code = $this->projectCodeBySlug($slug);
        $project_code->delete();
        
        $this->event->fire('project_code.destroy', $project_code);
        return redirect()->route('dashboard.project_code.index');

    }





    // Utility Methods

    public function projectCodeBySlug($slug){

        $project_code = $this->cache->remember('project_codes:bySlug:' . $slug, 240, function() use ($slug){
            return $this->project_code->findSlug($slug);
        });
        
        return $project_code;

    }






}