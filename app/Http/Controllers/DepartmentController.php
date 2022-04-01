<?php

namespace App\Http\Controllers;


use App\Models\Department;
use App\Swep\Services\DepartmentService;
use App\Http\Requests\Department\DepartmentFormRequest;
use App\Http\Requests\Department\DepartmentFilterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class DepartmentController extends Controller{



    protected $department;



    public function __construct(DepartmentService $department){

        $this->department = $department;

    }



    
    public function index(Request $request){
        if($request->ajax() && $request->draw != null){
            $depts = Department::query();
            return \DataTables::of($depts)
                ->addColumn('action',function ($data){
                    $destroy_route = "'".route("dashboard.department.destroy","slug")."'";
                    $slug = "'".$data->slug."'";
                    $button = '<div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm view_jo_employee_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#view_jo_employee_modal" title="View more" data-placement="left">
                                        <i class="fa fa-file-text"></i>
                                    </button>
                                   
                                    <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_dept_btn" data-toggle="modal" data-target="#edit_dept_modal" title="Edit" data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" data="'.$data->slug.'" onclick="delete_data('.$slug.','.$destroy_route.')" class="btn btn-sm btn-danger delete_jo_employee_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>';
                    return $button;
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->make(true);

        }
        return view('dashboard.department.index');
    }

    


    public function create(){

        return view('dashboard.department.create');

    }

    


    public function store(DepartmentFormRequest $request){
        $dept =  new Department();
        $dept->slug = Str::random();
        $dept->department_id = $request->department_id;
        $dept->name = $request->name;
        if($dept->save()){
            return $dept->only('slug');
        }
        abort(503,'Error saving data');
    }




    public function edit($slug){
        $dept = $this->findBySlug($slug);
        return view('dashboard.department.edit')->with([
            'dept' => $dept,
        ]);
        return $this->department->edit($slug);
        
    }




    public function update(DepartmentFormRequest $request, $slug){
        $dept = $this->findBySlug($slug);
        $dept->department_id = $request->department_id;
        $dept->name = $request->name;
        if($dept->update()){
            return $dept->only('slug');
        }
        abort(503,'Error updating data');
    }

    


    public function destroy($slug){
        $dept = $this->findBySlug($slug);
        if($dept->delete()){
            return 1;
        }
        abort(503,'Error deleting data');

    }


    private function findBySlug($slug){
        $dept = Department::query()->where('slug','=',$slug)->first();
        if(empty($dept)){
            abort(503,'Department not found');
        }
        return $dept;
    }

}
