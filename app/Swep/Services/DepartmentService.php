<?php
 
namespace App\Swep\Services;

use Auth;
use Session;
use App\Models\Departments;
use Illuminate\Http\Request;
use Illuminate\Events\Dispatcher;
use Illuminate\Cache\Repository as Cache;

class DepartmentService{


	protected $department;
    protected $event;
    protected $cache;
    protected $auth;
    protected $session;



    public function __construct(Departments $department, Dispatcher $event, Cache $cache){

        $this->department = $department;
        $this->event = $event;
        $this->cache = $cache;
        $this->auth = auth();
        $this->session = session();

    }




    public function fetchAll(Request $request){

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




    public function store(Request $request){

        $department = $this->department->create($request->all());
        $this->event->fire('department.create', [ $department, $request ]);
        $this->session->flash('DEPARTMENT_CREATE_SUCCESS', 'The Department has been successfully created!');
        return redirect()->back();

    }




    public function edit($slug){

        $department = $this->cache->remember('departments:bySlug:' . $slug, 240, function() use ($slug){
            return $this->department->findSlug($slug);
        }); 

        return view('dashboard.department.edit')->with('department', $department);

    }




    public function update(Request $request, $slug){

        $department = $this->cache->remember('departments:bySlug:' . $slug, 240, function() use ($slug){
            return $this->department->findSlug($slug);
        });

        $department->update($request->all());
        $this->event->fire('department.update', [ $department, $request ]);
        $this->session->flash('DEPARTMENT_UPDATE_SUCCESS', 'The Department has been successfully updated!');
        $this->session->flash('DEPARTMENT_UPDATE_SUCCESS_SLUG', $department->slug);
        return redirect()->route('dashboard.department.index');

    }




    public function destroy($slug){

        $department = $this->cache->remember('departments:bySlug:' . $slug, 240, function() use ($slug){
            return $this->department->findSlug($slug);
        });
        
        $department->delete();
        $this->event->fire('department.delete', [ $department ]);
        $this->session->flash('DEPARTMENT_DELETE_SUCCESS', 'The Department has been successfully deleted!');
        $this->session->flash('DEPARTMENT_DELETE_SUCCESS_SLUG', $department->slug);
        return redirect()->route('dashboard.department.index');

    }



}