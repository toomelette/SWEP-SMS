<?php
 
namespace App\Swep\Services;


use App\Models\Employee;
use App\Models\EmployeeChildren;
use App\Models\EmployeeEducationalBackground;
use App\Models\EmployeeTraining;
use App\Models\EmployeeEligibility;
use App\Models\EmployeeWorkExperience;
use App\Models\EmployeeVoluntaryWork;
use App\Models\EmployeeRecognition;
use App\Models\EmployeeOrganization;
use App\Models\EmployeeSpecialSkill;
use App\Models\EmployeeReference;
use App\Swep\BaseClasses\BaseService;


class EmployeeService extends BaseService{



	protected $employee;



    public function __construct(Employee $employee){

        $this->employee = $employee;
        parent::__construct();

    }





    public function fetchAll($request){

        $key = str_slug($request->fullUrl(), '_');

        $employees = $this->cache->remember('employees:all:' . $key, 240, function() use ($request){

            $employee = $this->employee->newQuery();
            
            if($request->q != null){
                $employee->search($request->q);
            }

            return $employee->populate();

        });

        $request->flash();
        return view('dashboard.employee.index')->with('employees', $employees);

    }






    public function store($request){

        $rows_children = $request->row_children;
        $rows_eb = $request->row_eb;
        $rows_training = $request->row_training;
        $rows_eligibility = $request->row_eligibility;
        $rows_we = $request->row_we;
        $rows_vw = $request->row_vw;
        $row_recognition = $request->row_recognition;
        $row_org = $request->row_org;
        $row_ss = $request->row_ss;
        $row_reference = $request->row_reference;

        $this->event->fire('employee.store');
        return redirect()->back();

    }





     public function show($slug){

        $employee = $this->employeeBySlug($slug);
        return view('dashboard.employee.show')->with('employee', $employee);

    }





    public function edit($slug){

        $employee = $this->employeeBySlug($slug);
        return view('dashboard.employee.edit')->with('employee', $employee);

    }






    public function update($request, $slug){

        $rows_children = $request->row_children;
        $rows_eb = $request->row_eb;
        $rows_training = $request->row_training;
        $rows_eligibility = $request->row_eligibility;
        $rows_we = $request->row_we;
        $rows_vw = $request->row_vw;
        $row_recognition = $request->row_recognition;
        $row_org = $request->row_org;
        $row_ss = $request->row_ss;
        $row_reference = $request->row_reference;

        $this->event->fire('employee.update', $employee);
        return redirect()->route('dashboard.employee.index');

    }






    public function destroy($slug){

        $employee = $this->employeeBySlug($slug);
        
        $this->event->fire('employee.destroy', $employee);
        return redirect()->route('dashboard.employee.index');

    }





    // Utility Methods

    public function employeeBySlug($slug){

        $employee = $this->cache->remember('employees:bySlug:' . $slug, 240, function() use ($slug){
            return $this->employee->findSlug($slug);
        });
        
        return $employee;

    }




    public function storeEmployeeChildren($row, $employee){

        $employee_children = new EmployeeChildren;
        $employee_children->employee_no = $employee->employee_no;
        $employee_children->fullname = $row['fullname'];
        $employee_children->date_of_birth = $this->dataTypeHelper->date_in($row['date_of_birth']);
        $employee_children->save();
        
    }




    public function storeEmployeeEducationalBackground($row, $employee){
        
        $employee_eb = new EmployeeEducationalBackground;
        $employee_eb->employee_no = $employee->employee_no;
        $employee_eb->level = $row['level'];
        $employee_eb->school_name = $row['school_name'];
        $employee_eb->course = $row['course'];
        $employee_eb->date_from = $this->dataTypeHelper->date_in($row['date_from']);
        $employee_eb->date_to = $this->dataTypeHelper->date_in($row['date_to']);
        $employee_eb->units = $row['units'];
        $employee_eb->graduate_year = $row['graduate_year'];
        $employee_eb->scholarship = $row['scholarship'];
        $employee_eb->save();

    }  




    public function storeEmployeeTraining($row, $employee){

        $employee_training = new EmployeeTraining;
        $employee_training->employee_no = $employee->employee_no;
        $employee_training->title = $row['title'];
        $employee_training->type = $row['type'];
        $employee_training->date_from = $this->dataTypeHelper->date_in($row['date_from']);
        $employee_training->date_to = $this->dataTypeHelper->date_in($row['date_to']);
        $employee_training->hours = $row['hours'];
        $employee_training->conducted_by = $row['conducted_by'];
        $employee_training->venue = $row['venue'];
        $employee_training->remarks = $row['remarks'];
        $employee_training->save();

    }




    public function storeEmployeeEligibility($row, $employee){

        $employee_eligibility = new EmployeeEligibility;
        $employee_eligibility->employee_no = $employee->employee_no;
        $employee_eligibility->eligibility = $row['eligibility'];
        $employee_eligibility->level = $row['level'];
        $employee_eligibility->rating = $row['rating'];
        $employee_eligibility->exam_place = $row['exam_place'];
        $employee_eligibility->exam_date = $this->dataTypeHelper->date_in($row['exam_date']);
        $employee_eligibility->license_no = $row['license_no'];
        $employee_eligibility->license_validity = $this->dataTypeHelper->date_in($row['license_validity']);
        $employee_eligibility->save();

    }




    public function storeEmployeeWorkExperience($row, $employee){

        $employee_we = new EmployeeWorkExperience;
        $employee_we->employee_no = $employee->employee_no;
        $employee_we->date_from = $this->dataTypeHelper->date_in($row['date_from']);
        $employee_we->date_to = $this->dataTypeHelper->date_in($row['date_to']);
        $employee_we->position = $row['position'];
        $employee_we->company = $row['company'];
        $employee_we->salary = $this->dataTypeHelper->string_to_num($row['salary']);
        $employee_we->salary_grade = $row['salary_grade'];
        $employee_we->appointment_status = $row['appointment_status'];
        $employee_we->is_gov_service =  $this->dataTypeHelper->string_to_boolean($row['is_gov_service']);
        $employee_we->save();

    }




    public function storeEmployeeVoluntaryWork($row, $employee){

        $employee_vw = new EmployeeVoluntaryWork;
        $employee_vw->employee_no = $employee->employee_no;
        $employee_vw->name = $row['name'];
        $employee_vw->address = $row['address'];
        $employee_vw->date_from = $this->dataTypeHelper->date_in($row['date_from']);
        $employee_vw->date_to = $this->dataTypeHelper->date_in($row['date_to']);
        $employee_vw->hours = $row['hours'];
        $employee_vw->position = $row['position'];
        $employee_vw->save();

    }




    public function storeEmployeeRecognition($row, $employee){

        $employee_recognition = new EmployeeRecognition;
        $employee_recognition->employee_no = $employee->employee_no;
        $employee_recognition->title = $row['title'];
        $employee_recognition->save();

    }




    public function storeEmployeeOrganization($row, $employee){

        $employee_org = new EmployeeOrganization;
        $employee_org->employee_no = $employee->employee_no;
        $employee_org->name = $row['name'];
        $employee_org->save();

    }




    public function storeEmployeeSpecialSkill($row, $employee){

        $employee_ss = new EmployeeSpecialSkill;
        $employee_ss->employee_no = $employee->employee_no;
        $employee_ss->description = $row['description'];
        $employee_ss->save();

    }




    public function storeEmployeeReference($row, $employee){

        $employee_reference = new EmployeeReference;
        $employee_reference->employee_no = $employee->employee_no;
        $employee_reference->fullname = $row['fullname'];
        $employee_reference->address = $row['address'];
        $employee_reference->tel_no = $row['tel_no'];
        $employee_reference->save();

    }





}