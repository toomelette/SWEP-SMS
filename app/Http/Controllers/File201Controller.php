<?php


namespace App\Http\Controllers;


use App\Http\Requests\Employee\EmployeeFile201FormRequest;
use App\Models\EmployeeFile201;
use App\Models\NewsAttachments;
use App\Swep\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class File201Controller extends Controller
{
    public function __construct()
    {
        $this->path = 'HR/File201/';
    }

    public function index(Request $request, EmployeeController $employeeController){
        if($request->draw != null){
            $file201 = EmployeeFile201::query();
            $employee = $employeeController->findEmployeeBySlug($request->employee);
            $file201 = $file201->where('employee_no' ,'=',$employee->employee_no);
            $dt = DataTables::of($file201)
                ->addColumn('action',function ($data){
                    return 1;
                })
                ->editColumn('filename',function ($data){
                    return '<a href="'.route("dashboard.view_document.index",[$data->slug,'view_201File']).'" target="_blank"><i class="fa fa-paperclip"></i> '.$data->filename.'</a>';
                })
                ->escapeColumns([])
                ->setRowId('slug')
                ->make(true);

            return $dt;
        }
        if(!empty($request->employee) && $request->employee == null){
            abort(503,'Missing Parameters');
        }

        $employee = $employeeController->findEmployeeBySlug($request->employee);
        return view('dashboard.employee.file201.index')->with([
            'employee' => $employee,
        ]);
    }

    public function create(Request $request, EmployeeController $employeeController){
        $employee = $employeeController->findEmployeeBySlug($request->employee);
        return view('dashboard.employee.file201.create')->with([
            'employee' => $employee,
        ]);
    }

    public function store(EmployeeFile201FormRequest $request, EmployeeController $employeeController){

        $filesArr = [];
        $employee = $employeeController->findEmployeeBySlug($request->employee);
        $file201 = new EmployeeFile201;
        $file201->slug =Str::random();
        $file201->title = ucfirst($request->title);
        $file201->description = ucfirst($request->description);

        if(!empty($request->doc_file)){
            foreach ($request->file('doc_file') as $file){
                if(Helper::convertFromBytes($file->getSize(),'MB') > 5){
                    abort(503,'Max file size: 5Mb');
                }
                $original_ext = $file->getClientOriginalExtension();
                $original_file_name_only = str_replace('.'.$original_ext,'',$file->getClientOriginalName());
                $new_file_name_full = $original_file_name_only.'-'.Str::random(10).'.'.$original_ext;
                $slug = Str::random();
                $file->storeAs($this->path.$employee->employee_no.'/',$new_file_name_full);
                $file201->employee_no = $employee->employee_no;
                $file201->filename = $new_file_name_full;
                $file201->original_filename =  $original_file_name_only.'.'.$original_ext;
            }
        }else{
            abort(503,'At least 1 attachment is required.');
        }

        if($file201->save()){
            return $file201->only('slug');
        }
        abort(503,'Error saving data.');
    }
}