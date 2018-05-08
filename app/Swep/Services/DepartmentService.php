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

       

    }




    public function store(Request $request){

        $department = $this->department->create($request->all());
        $this->event->fire('department.create', [ $department, $request ]);
        $this->session->flash('DEPARTMENT_CREATE_SUCCESS', 'The Department has been successfully created!');
        return redirect()->back();

    }




    public function edit($slug){


    }




    public function update(Request $request, $slug){


    }




    public function destroy($slug){


    }


}