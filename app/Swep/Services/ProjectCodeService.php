<?php
 
namespace App\Swep\Services;

use App\Swep\Interfaces\ProjectCodeInterface;
use App\Swep\BaseClasses\BaseService;


class ProjectCodeService extends BaseService{


    protected $project_code_repo;



    public function __construct(ProjectCodeInterface $project_code_repo){

        $this->project_code_repo = $project_code_repo;
        parent::__construct();

    }





    public function fetch($request){

        $project_codes = $this->project_code_repo->fetch($request);
        
        $request->flash();
        return view('dashboard.project_code.index')->with('project_codes', $project_codes);

    }






    public function store($request){

        $project_code = $this->project_code_repo->store($request);

        $this->event->fire('project_code.store', $project_code);
        return redirect()->back();

    }






    public function edit($slug){

        $project_code = $this->project_code_repo->findBySlug($slug);
        return view('dashboard.project_code.edit')->with('project_code', $project_code);

    }






    public function update($request, $slug){

        $project_code = $this->project_code_repo->update($request, $slug);

        $this->event->fire('project_code.update', $project_code);
        return redirect()->route('dashboard.project_code.index');

    }






    public function destroy($slug){

        $project_code = $this->project_code_repo->destroy($slug);
        
        $this->event->fire('project_code.destroy', $project_code);
        return redirect()->back();

    }







}