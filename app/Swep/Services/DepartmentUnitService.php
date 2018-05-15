<?php
 
namespace App\Swep\Services;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Models\DepartmentUnit;
use Illuminate\Events\Dispatcher;
use Illuminate\Cache\Repository as Cache;

class DepartmentUnitService{


	protected $department_unit;
    protected $event;
    protected $cache;
    protected $auth;
    protected $session;



    public function __construct(DepartmentUnit $department_unit, Dispatcher $event, Cache $cache){

        $this->department_unit = $department_unit;
        $this->event = $event;
        $this->cache = $cache;
        $this->auth = auth();
        $this->session = session();

    }




    public function fetchAll(Request $request){

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




    public function store(Request $request){

        $department_unit = $this->department_unit->create($request->all());
        $this->event->fire('department_unit.create', [ $department_unit, $request ]);
        $this->session->flash('DEPARTMENT_UNIT_CREATE_SUCCESS', 'The Department Unit has been successfully created!');
        return redirect()->back();

    }




    public function edit($slug){

        $department_unit = $this->cache->remember('department_units:bySlug:' . $slug, 240, function() use ($slug){
            return $this->department_unit->findSlug($slug);
        }); 

        return view('dashboard.department_unit.edit')->with('department_unit', $department_unit);

    }




    public function update(Request $request, $slug){

        $department_unit = $this->cache->remember('department_units:bySlug:' . $slug, 240, function() use ($slug){
            return $this->department_unit->findSlug($slug);
        });

        $department_unit->update($request->all());
        $this->event->fire('department_unit.update', [ $department_unit, $request ]);
        $this->session->flash('DEPARTMENT_UNIT_UPDATE_SUCCESS', 'The Department Unit has been successfully updated!');
        $this->session->flash('DEPARTMENT_UNIT_UPDATE_SUCCESS_SLUG', $department_unit->slug);
        return redirect()->route('dashboard.department_unit.index');

    }




    public function destroy($slug){

        $department_unit = $this->cache->remember('department_units:bySlug:' . $slug, 240, function() use ($slug){
            return $this->department_unit->findSlug($slug);
        });
        
        $department_unit->delete();
        $this->event->fire('department_unit.delete', [ $department_unit ]);
        $this->session->flash('DEPARTMENT_UNIT_DELETE_SUCCESS', 'The Department Unit has been successfully deleted!');
        $this->session->flash('DEPARTMENT_UNIT_DELETE_SUCCESS_SLUG', $department_unit->slug);
        return redirect()->route('dashboard.department_unit.index');

    }



}