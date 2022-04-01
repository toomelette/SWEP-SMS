<?php

namespace App\Http\Controllers;

use App\Models\DepartmentUnit;
use App\Swep\Helpers\Helper;
use App\Swep\Services\DepartmentUnitService;
use App\Http\Requests\DepartmentUnit\DepartmentUnitFormRequest;
use App\Http\Requests\DepartmentUnit\DepartmentUnitFilterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class DepartmentUnitController extends Controller{


    protected $department_unit;



    public function __construct(DepartmentUnitService $department_unit){

        $this->department_unit = $department_unit;

    }



    
    public function index(Request $request){

        if($request->ajax() && $request->draw != ''){
            $dus = DepartmentUnit::query()->with('department');
            return \DataTables::of($dus)
                ->addColumn('action',function ($data){
                    $destroy_route = "'".route("dashboard.department_unit.destroy","slug")."'";
                    $slug = "'".$data->slug."'";
                    $button = '<div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm view_jo_employee_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#view_jo_employee_modal" title="View more" data-placement="left">
                                        <i class="fa fa-file-text"></i>
                                    </button>
                                   
                                    <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_unit_btn" data-toggle="modal" data-target="#edit_unit_modal" title="Edit" data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" data="'.$data->slug.'" onclick="delete_data('.$slug.','.$destroy_route.')" class="btn btn-sm btn-danger delete_jo_employee_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>';
                    return $button;
                })
                ->editColumn('department_id',function ($data){
                    if(!empty($data->department)){
                        return $data->department->name;
                    }
                    return $data->department_id;
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->make(true);
        }
        return view('dashboard.department_unit.index');

    }

    



    public function create(){

        return view('dashboard.department_unit.create');

    }

   



    public function store(DepartmentUnitFormRequest $request){
        $du = new DepartmentUnit;
        $du->slug = Str::random();
        $du->department_id = $request->department_id;
        $du->name = $request->name;
        $du->description = $request->description;
        if($du->save()){
            return $du->only('slug');
        }
        abort(503,'Error saving data.');
    }

    
    private function findBySlug($slug){
        $du = DepartmentUnit::query()->with('department')->where('slug','=',$slug)->first();
        if(empty($du)){
            abort(503,'Department Unit not found');
        }
        return $du;
    }

    public function edit($slug){
        $du = $this->findBySlug($slug);

        return view('dashboard.department_unit.edit')->with([
            'du' => $du,
        ]);
    }

    


    public function update(DepartmentUnitFormRequest $request, $slug){
        $du = $this->findBySlug($slug);
        $du->department_id = $request->department_id;
        $du->name = $request->name;
        $du->description = $request->description;
        if($du->update()){
            return $du->only('slug');
        }
        abort(503,'Error updating data.');

    }

    



    public function destroy($slug){
        $du = $this->findBySlug($slug);
        if($du->delete()){
            return 1;
        }

    }




}
