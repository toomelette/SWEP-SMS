<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Employee\EducationalBGController;
use App\Http\Controllers\Employee\EligibilityController;
use App\Http\Controllers\Employee\WorkExperienceController;
use App\Models\EmployeeEducationalBackground;

class EmployeeCredentialsController extends Controller
{
    public function index($slug, EmployeeController $employeeController, EducationalBGController $educationalBGController,EligibilityController $eligibilityController,WorkExperienceController $workExperienceController){

        $employee = $employeeController->findEmployeeBySlug($slug);
        if(request('for') == 'educ_bg'){
            return $educationalBGController->dataTable($employee->employee_no);
        }
        if(request('for') == 'elig'){
            return $eligibilityController->dataTable($employee->employee_no);
        }
        if(request('for') == 'work'){
            return $workExperienceController->dataTable($employee->employee_no);
        }
        return view('dashboard.employee.credentials.index')->with([
            'employee' => $employee,
        ]);
    }



    public function educBgCreate($slug, EmployeeController $employeeController){
        if(request('for') == 'create'){
            $e = $employeeController->findEmployeeBySlug($slug);
            return view('dashboard.employee.credentials.educ_bg.create')->with([
                'employee' => $e,
            ]);
        }
        if(request('for') == 'edit'){
            return 1;
            $e = $employeeController->findEmployeeBySlug($slug);
            return view('dashboard.employee.credentials.educ_bg.create')->with([
                'employee' => $e,
            ]);
        }
    }

}