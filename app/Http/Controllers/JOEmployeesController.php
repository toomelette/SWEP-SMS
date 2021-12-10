<?php


namespace App\Http\Controllers;


use App\Http\Requests\JoEmployees\JoEmployeesFormRequest;
use App\Models\JoEmployees;
use App\Models\User;
use App\Swep\ViewHelpers\__html;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class JOEmployeesController extends Controller
{
    public function index(){

        if(request()->ajax()){
            if(request()->has('draw')){
                $jo_employees = JoEmployees::query();

                return DataTables::of($jo_employees)
                    ->addColumn('fullname',function ($data){
                        return $data->lastname.', '.$data->firstname;
                    })
                    ->addColumn('action', function ($data){
                        $destroy_route = "'".route("dashboard.jo_employees.destroy","slug")."'";
                        $slug = "'".$data->slug."'";
                        $button = '<div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm view_jo_employee_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#view_jo_employee_modal" title="View more" data-placement="left">
                                        <i class="fa fa-file-text"></i>
                                    </button>
                                   
                                    <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_jo_employee_btn" data-toggle="modal" data-target="#edit_jo_employee_modal" title="Edit" data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" data="'.$data->slug.'" onclick="delete_data('.$slug.','.$destroy_route.')" class="btn btn-sm btn-danger delete_jo_employee_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>';
                        return $button;
                    })
                    ->addColumn('birthday_age', function ($data){
                        return Carbon::parse($data->birthday)->format('M. d, Y').' | '.Carbon::parse($data->birthday)->age;
                    })
                    ->editColumn('sex',function ($data){
                        return __html::sex($data->sex);
                    })
                    ->escapeColumns([])
                    ->setRowId('slug')
                    ->toJson();
            }
        }
        return view('dashboard.jo_employee.index');
    }

    public function store(JoEmployeesFormRequest $request){
        $password = Carbon::parse($request->birthday)->format('mdy');
        $jo = new JoEmployees;
        $jo->slug = Str::random(16);
        $jo->biometric_user_id = $request->biometric_user_id;
        $jo->address_detailed = ucfirst($request->address_detailed);
        $jo->birthday = $request->birthday;
        $jo->sex = $request->sex;
        $jo->brgy = $request->brgy;
        $jo->city = $request->city;
        $jo->civil_status = $request->civil_status;
        $jo->department_unit = $request->department_unit;
        $jo->email = $request->email;
        $jo->employee_no = $request->employee_no;
        $jo->firstname = ucwords($request->firstname);
        $jo->lastname = ucwords($request->lastname);
        $jo->middlename = ucwords($request->middlename);
        $jo->name_ext = $request->name_ext;
        $jo->phone = $request->phone;
        $jo->position = $request->position;
        $jo->province = $request->province;
        if($jo->save()){
            $user = new User;
            $user->slug = Str::random(16);
            $user->id = rand(142332,999999);
            $user->email = $request->email;
            $user->username = $request->username;
            $user->password = Hash::make($password);
            $user->color = 'skin-green sidebar-mini';
            $user->employee_no = $request->employee_no;
            $user->save();

            return $jo->only('slug');
        }
        abort(500,'Error saving');
    }

    public function edit($slug){
        $jo = JoEmployees::query()->where('slug','=',$slug)->first();
        if(!empty($jo)){
            return view('dashboard.jo_employee.edit')->with([
                'jo' => $jo,
            ]);
        }
        abort(404);
    }

    public function update(JoEmployeesFormRequest $request, $slug){

        $jo = JoEmployees::query()->where('slug','=',$slug)->first();
        if(!empty($jo)){

            $jo->biometric_user_id = $request->biometric_user_id;
            $jo->address_detailed = ucfirst($request->address_detailed);
            $jo->birthday = $request->birthday;
            $jo->sex = $request->sex;
            $jo->brgy = $request->brgy;
            $jo->city = $request->city;
            $jo->civil_status = $request->civil_status;
            $jo->department_unit = $request->department_unit;
            $jo->email = $request->email;
            $jo->employee_no = $request->employee_no;
            $jo->firstname = ucwords($request->firstname);
            $jo->lastname = ucwords($request->lastname);
            $jo->middlename = ucwords($request->middlename);
            $jo->name_ext = $request->name_ext;
            $jo->phone = $request->phone;
            $jo->position = $request->position;
            $jo->province = $request->province;
            if($jo->update()){
                return $jo->only('slug');
            }else{
                abort(503,'Error Saving');
            }
        }else{
            abort(503,'Data not found');
        }
    }

    public function destroy($slug){
        $jo = JoEmployees::query()->where('slug','=',$slug)->first();

        if(!empty($jo)){
            if($jo->delete()){
                return 1;
            }else{
                abort(503,'Error deleting data');
            }

        }else{
            abort(503,'Cannot find data');
        }
    }

    public function show($slug){
        $jo = JoEmployees::query()->where('slug','=',$slug)->first();

        if(!empty($jo)){
            return view('dashboard.jo_employee.show')->with([
                'jo' => $jo
            ]);
        }else{
            abort(503,'Cannot find data');
        }
    }
}