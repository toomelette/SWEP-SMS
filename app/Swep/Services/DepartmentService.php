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

        $department = $this->department->create($request->all());
        $this->event->fire('department.create', [ $department, $request ]);
        $this->session->flash('DEPARTMENT_CREATE_SUCCESS', 'The Department has been successfully created!');
        return redirect()->back();

    }





    public function edit($slug){

        $department = $this->departmentsBySlug($slug);
        return view('dashboard.department.edit')->with('department', $department);

    }





    public function update($request, $slug){

        $department = $this->departmentsBySlug($slug);
        $department->update($request->all());
        $this->event->fire('department.update', [ $department, $request ]);
        $this->session->flash('DEPARTMENT_UPDATE_SUCCESS', 'The Department has been successfully updated!');
        $this->session->flash('DEPARTMENT_UPDATE_SUCCESS_SLUG', $department->slug);
        return redirect()->route('dashboard.department.index');

    }





    public function destroy($slug){

        $department = $this->departmentsBySlug($slug);
        $department->delete();
        $this->event->fire('department.delete', [ $department ]);
        $this->session->flash('DEPARTMENT_DELETE_SUCCESS', 'The Department has been successfully deleted!');
        $this->session->flash('DEPARTMENT_DELETE_SUCCESS_SLUG', $department->slug);
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