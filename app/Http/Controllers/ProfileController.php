<?php

namespace App\Http\Controllers;


use App\Http\Requests\EmployeeServiceRecord\EmployeeServiceRecordCreateForm;
use App\Models\EmployeeChildren;
use App\Models\EmployeeFamilyDetail;
use App\Models\EmployeeServiceRecord;
use App\Models\User;
use App\Swep\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Swep\Services\ProfileService;
use App\Http\Requests\Profile\ProfileUpdateAccountUsernameRequest;
use App\Http\Requests\Profile\ProfileUpdateAccountPasswordRequest;
use App\Http\Requests\Profile\ProfileUpdateAccountColorRequest;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller{



	protected $profile_service; 



    public function __construct(ProfileService $profile_service){

        $this->profile_service = $profile_service;

    }




	public function details(){
        $user = User::query()->with(['employee'])->find(\Auth::user()->id);

        return view('dashboard.profile.details')->with([
            'user' => $user,
        ]);
        
    }




    public function updateAccountUsername(ProfileUpdateAccountUsernameRequest $request, $slug){

        return $this->profile_service->updateAccountUsername($request, $slug);
        
    }




    public function updateAccountPassword(ProfileUpdateAccountPasswordRequest $request, $slug){

        return $this->profile_service->updateAccountPassword($request, $slug);
        
    }


    

    public function updateAccountColor(ProfileUpdateAccountColorRequest $request, $slug){

        return $this->profile_service->updateAccountColor($request, $slug);
        
    }


    

    public function printPds($slug, $page){
        return $this->profile_service->printPds($slug, $page);
    }


    public function saveFamilyInfo(Request $request){
        $employee = $this->findEmployeeLinkedToThisAccount();
        $employee_no = \Auth::user()->employee->employee_no;
        $status = 1;
        //Save Family Info
        if(!empty($employee->employeeFamilyDetail)){
            $fd = $employee->employeeFamilyDetail;
            $fd->spouse_lastname = $request->spouse_lastname;
            $fd->spouse_firstname = $request->spouse_firstname;
            $fd->spouse_middlename = $request->spouse_middlename;
            $fd->spouse_name_ext = $request->spouse_name_ext;
            $fd->spouse_birthdate = $request->spouse_birthdate;
            $fd->spouse_occupation = $request->spouse_occupation;
            $fd->spouse_employer = $request->spouse_employer;
            $fd->spouse_business_address = $request->spouse_business_address;
            $fd->spouse_tel_no = $request->spouse_tel_no;
            $fd->father_lastname = $request->father_lastname;
            $fd->father_firstname = $request->father_firstname;
            $fd->father_middlename = $request->father_middlename;
            $fd->father_name_ext = $request->father_name_ext;
            $fd->mother_lastname = $request->mother_lastname;
            $fd->mother_firstname = $request->mother_firstname;
            $fd->mother_middlename = $request->mother_middlename;
            $fd->mother_name_ext = $request->mother_name_ext;
            $fd->save();
        }else{
            $fd = new EmployeeFamilyDetail;
            $fd->employee_no = $employee_no;
            $fd->spouse_lastname = $request->spouse_lastname;
            $fd->spouse_firstname = $request->spouse_firstname;
            $fd->spouse_middlename = $request->spouse_middlename;
            $fd->spouse_name_ext = $request->spouse_name_ext;
            $fd->spouse_birthdate = $request->spouse_birthdate;
            $fd->spouse_occupation = $request->spouse_occupation;
            $fd->spouse_employer = $request->spouse_employer;
            $fd->spouse_business_address = $request->spouse_business_address;
            $fd->spouse_tel_no = $request->spouse_tel_no;
            $fd->father_lastname = $request->father_lastname;
            $fd->father_firstname = $request->father_firstname;
            $fd->father_middlename = $request->father_middlename;
            $fd->father_name_ext = $request->father_name_ext;
            $fd->mother_lastname = $request->mother_lastname;
            $fd->mother_firstname = $request->mother_firstname;
            $fd->mother_middlename = $request->mother_middlename;
            $fd->mother_name_ext = $request->mother_name_ext;
            $fd->save();


        }
        if(!empty($request->fullname)){
            if(count($request->fullname) > 0){
                $employee->employeeChildren()->delete();
                $childrenArr = [];
                $count = count($request->fullname);
                for($x = 0; $x <= $count-1;$x++){
                    array_push($childrenArr,[
                        'employee_no' => $employee_no,
                        'fullname' => $request->fullname[$x],
                        'date_of_birth' => Carbon::parse($request->date_of_birth[$x])->format('Y-m-d'),
                        'school_company' => $request->school_company[$x],
                        'civil_status' => $request->civil_status[$x],
                    ]);
                }
                $children = EmployeeChildren::insert($childrenArr);
            }
        }
        if($status == 1){
            return 1;
        }else{
            abort(503, 'Error saving family information');
        }
    }

    private function findEmployeeLinkedToThisAccount(){
        if(empty(\Auth::user()->employee)){
            abort(503,'Employee cannot be null');
        }
        $emp  = \Auth::user()->employee;
        return $emp;
    }

    public function serviceRecord(EmployeeController $employeeController){
        return $employeeController->serviceRecord(Auth::user()->employee->slug);
    }

    public function serviceRecordStore(EmployeeController $employeeController, EmployeeServiceRecordCreateForm $request){
        return $employeeController->serviceRecordStore($request,Auth::user()->employee->slug);
    }

    public function serviceRecordEdit(EmployeeController $employeeController){
        $this->checkPermission(request('sr'));
        return $employeeController->serviceRecord(Auth::user()->employee->slug);
    }

    public function serviceRecordDestroy(EmployeeController $employeeController,$slug){
        $this->checkPermission($slug);
        return $employeeController->serviceRecordDestroy($slug);
    }

    public function serviceRecordUpdate(EmployeeServiceRecordCreateForm $request,$slug, EmployeeController $employeeController){
        $this->checkPermission($slug);
        return $employeeController->serviceRecordUpdate($request,$slug);
    }

    private function checkPermission($service_record_slug){
        $sr = EmployeeServiceRecord::query()->where('slug' , '=',$service_record_slug)->first();
        if(Auth::user()->employee_no !== $sr->employee_no){
            abort(503,'Insufficient permission.');
        }
    }
}
