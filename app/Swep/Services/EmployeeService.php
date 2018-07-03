<?php
 
namespace App\Swep\Services;

use App\Models\Employee;
use App\Models\EmployeeFamilyDetail;
use App\Models\EmployeeAddress;
use App\Models\EmployeeOtherQuestion;
use App\Models\EmployeeChildren;
use App\Models\EmployeeEducationalBackground;
use App\Models\EmployeeTraining;
use App\Models\EmployeeEligibility;
use App\Models\EmployeeExperience;
use App\Models\EmployeeVoluntaryWork;
use App\Models\EmployeeRecognition;
use App\Models\EmployeeOrganization;
use App\Models\EmployeeSpecialSkill;
use App\Models\EmployeeReference;
use App\Models\EmployeeServiceRecord;
use App\Swep\BaseClasses\BaseService;



class EmployeeService extends BaseService{



	protected $employee;
    protected $employee_sr;



    public function __construct(Employee $employee, EmployeeServiceRecord $employee_sr){

        $this->employee = $employee;
        $this->employee_sr = $employee_sr;
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

        $employee = new Employee;
        $employee->slug = $this->str->random(16);
        $employee->user_id = $this->auth->user()->user_id;
        $employee->project_id = $request->project_id;
        $employee->department_id = $request->department_id;
        $employee->department_unit_id = $request->department_unit_id;
        $employee->employee_no = $request->employee_no;
        $employee->lastname = $request->lastname;
        $employee->firstname = $request->firstname;
        $employee->middlename = $request->middlename;
        $employee->name_ext = $request->name_ext;
        $employee->fullname = $this->getFullname($request);
        $employee->date_of_birth = $this->dataTypeHelper->date_in($request->date_of_birth);
        $employee->place_of_birth = $request->place_of_birth;
        $employee->sex = $request->sex;
        $employee->civil_status = $request->civil_status;
        $employee->height = $request->height;
        $employee->weight = $request->weight;
        $employee->blood_type = $request->blood_type;
        $employee->citizenship = $request->citizenship;
        $employee->citizenship_type = $request->citizenship_type;
        $employee->dual_citizenship_country = $request->dual_citizenship_country;
        $employee->tel_no = $request->tel_no;
        $employee->cell_no = $request->cell_no;
        $employee->email = $request->email;
        $employee->agency_no = $request->agency_no;
        $employee->gov_id = $request->gov_id;
        $employee->license_passport_no = $request->license_passport_no;
        $employee->id_date_issue = $request->id_date_issue;
        $employee->gsis = $request->gsis;
        $employee->philhealth = $request->philhealth;
        $employee->sss = $request->sss;
        $employee->tin = $request->tin;
        $employee->hdmf = $request->hdmf;
        $employee->hdmfpremiums = $this->dataTypeHelper->string_to_num($request->hdmfpremiums);
        $employee->appointment_status = $request->appointment_status;
        $employee->position = $request->position;
        $employee->item_no = $request->item_no;
        $employee->salary_grade = $request->salary_grade;
        $employee->step_inc = $request->step_inc;
        $employee->monthly_basic = $this->dataTypeHelper->string_to_num($request->monthly_basic);
        $employee->aca = $this->dataTypeHelper->string_to_num($request->aca);
        $employee->pera = $this->dataTypeHelper->string_to_num($request->pera);
        $employee->food_subsidy = $this->dataTypeHelper->string_to_num($request->food_subsidy);
        $employee->ra = $this->dataTypeHelper->string_to_num($request->ra);
        $employee->ta = $this->dataTypeHelper->string_to_num($request->ta);
        $employee->firstday_gov = $this->dataTypeHelper->date_in($request->firstday_gov);
        $employee->firstday_sra = $this->dataTypeHelper->date_in($request->firstday_sra);
        $employee->appointment_date = $this->dataTypeHelper->date_in($request->appointment_date);
        $employee->adjustment_date = $this->dataTypeHelper->date_in($request->adjustment_date);
        $employee->is_active = $this->dataTypeHelper->string_to_boolean($request->is_active);
        $employee->created_at = $this->carbon->now();
        $employee->updated_at = $this->carbon->now();
        $employee->ip_created = request()->ip();
        $employee->ip_updated = request()->ip();
        $employee->user_created = $this->auth->user()->user_id;
        $employee->user_updated = $this->auth->user()->user_id;
        $employee->save();

        $this->fillDependencies($request, $employee);

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

        $employee = $this->employeeBySlug($slug);
        $employee->project_id = $request->project_id;
        $employee->department_id = $request->department_id;
        $employee->department_unit_id = $request->department_unit_id;
        $employee->employee_no = $request->employee_no;
        $employee->lastname = $request->lastname;
        $employee->firstname = $request->firstname;
        $employee->middlename = $request->middlename;
        $employee->name_ext = $request->name_ext;
        $employee->fullname = $this->getFullname($request);
        $employee->date_of_birth = $this->dataTypeHelper->date_in($request->date_of_birth);
        $employee->place_of_birth = $request->place_of_birth;
        $employee->sex = $request->sex;
        $employee->civil_status = $request->civil_status;
        $employee->height = $request->height;
        $employee->weight = $request->weight;
        $employee->blood_type = $request->blood_type;
        $employee->citizenship = $request->citizenship;
        $employee->citizenship_type = $request->citizenship_type;
        $employee->dual_citizenship_country = $request->dual_citizenship_country;
        $employee->tel_no = $request->tel_no;
        $employee->cell_no = $request->cell_no;
        $employee->email = $request->email;
        $employee->agency_no = $request->agency_no;
        $employee->gov_id = $request->gov_id;
        $employee->license_passport_no = $request->license_passport_no;
        $employee->id_date_issue = $request->id_date_issue;
        $employee->gsis = $request->gsis;
        $employee->philhealth = $request->philhealth;
        $employee->sss = $request->sss;
        $employee->tin = $request->tin;
        $employee->hdmf = $request->hdmf;
        $employee->hdmfpremiums = $this->dataTypeHelper->string_to_num($request->hdmfpremiums);
        $employee->appointment_status = $request->appointment_status;
        $employee->position = $request->position;
        $employee->item_no = $request->item_no;
        $employee->salary_grade = $request->salary_grade;
        $employee->step_inc = $request->step_inc;
        $employee->monthly_basic = $this->dataTypeHelper->string_to_num($request->monthly_basic);
        $employee->aca = $this->dataTypeHelper->string_to_num($request->aca);
        $employee->pera = $this->dataTypeHelper->string_to_num($request->pera);
        $employee->food_subsidy = $this->dataTypeHelper->string_to_num($request->food_subsidy);
        $employee->ra = $this->dataTypeHelper->string_to_num($request->ra);
        $employee->ta = $this->dataTypeHelper->string_to_num($request->ta);
        $employee->firstday_gov = $this->dataTypeHelper->date_in($request->firstday_gov);
        $employee->firstday_sra = $this->dataTypeHelper->date_in($request->firstday_sra);
        $employee->appointment_date = $this->dataTypeHelper->date_in($request->appointment_date);
        $employee->adjustment_date = $this->dataTypeHelper->date_in($request->adjustment_date);
        $employee->is_active = $this->dataTypeHelper->string_to_boolean($request->is_active);
        $employee->updated_at = $this->carbon->now();
        $employee->ip_updated = request()->ip();
        $employee->user_updated = $this->auth->user()->user_id;
        $employee->save();

        $this->removeDependencies($employee);

        $this->fillDependencies($request, $employee);

        $this->event->fire('employee.update', $employee);
        return redirect()->route('dashboard.employee.index');

    }






    public function destroy($slug){

        $employee = $this->employeeBySlug($slug);
        $employee->delete();
        $this->removeDependencies($employee);

        $this->event->fire('employee.destroy', $employee);
        return redirect()->route('dashboard.employee.index');

    }






    public function printPDS($slug, $page){

        $employee = $this->employeeBySlug($slug);

        if($page == 'p1'){
            return view('printables.employee_pds_p1')->with('employee', $employee);
        }elseif($page == 'p2'){
            return view('printables.employee_pds_p2')->with('employee', $employee);
        }elseif($page == 'p3'){
            return view('printables.employee_pds_p3')->with('employee', $employee);
        }elseif($page == 'p4'){
            return view('printables.employee_pds_p4')->with('employee', $employee);
        }

        return abort(404);

    }






    public function printInfo($slug){

        $employee = $this->employeeBySlug($slug);
        return view('printables.employee_info')->with('employee', $employee);

    }





    public function serviceRecord($slug){

        $employee = $this->employeeBySlug($slug);
        return view('dashboard.employee.service_record')->with('employee', $employee);

    }




    public function serviceRecordStore($request, $slug){

        $employee = $this->employeeBySlug($slug);

        $employee_sr = new EmployeeServiceRecord;
        $employee_sr->slug = $this->str->random(32);
        $employee_sr->employee_no = $employee->employee_no;
        $employee_sr->sequence_no = $request->sequence_no;
        $employee_sr->date_from = $request->date_from;
        $employee_sr->date_to = $request->date_to;
        $employee_sr->position = $request->position;
        $employee_sr->appointment_status = $request->appointment_status;
        $employee_sr->salary = $this->dataTypeHelper->string_to_num($request->salary);
        $employee_sr->mode_of_payment = $request->mode_of_payment;
        $employee_sr->station = $request->station;
        $employee_sr->gov_serve = $request->gov_serve;
        $employee_sr->psc_serve = $request->psc_serve;
        $employee_sr->lwp = $request->lwp;
        $employee_sr->spdate = $request->spdate;
        $employee_sr->status = $request->status;
        $employee_sr->remarks = $request->remarks;
        $employee_sr->save();

        $this->event->fire('employee.service_record_store', $employee_sr);
        return redirect()->route('dashboard.employee.service_record', $employee->slug);

    }




    public function serviceRecordUpdate($request, $emp_slug, $emp_sr_slug){

        $employee = $this->employeeBySlug($emp_slug);

        $employee_sr = $this->employeeSrBySlug($emp_sr_slug);
        $employee_sr->sequence_no = $request->e_sequence_no;
        $employee_sr->date_from = $request->e_date_from;
        $employee_sr->date_to = $request->e_date_to;
        $employee_sr->position = $request->e_position;
        $employee_sr->appointment_status = $request->e_appointment_status;
        $employee_sr->salary = $this->dataTypeHelper->string_to_num($request->e_salary);
        $employee_sr->mode_of_payment = $request->e_mode_of_payment;
        $employee_sr->station = $request->e_station;
        $employee_sr->gov_serve = $request->e_gov_serve;
        $employee_sr->psc_serve = $request->e_psc_serve;
        $employee_sr->lwp = $request->e_lwp;
        $employee_sr->spdate = $request->e_spdate;
        $employee_sr->status = $request->e_status;
        $employee_sr->remarks = $request->e_remarks;
        $employee_sr->save();

        $this->event->fire('employee.service_record_update', $employee_sr);
        return redirect()->route('dashboard.employee.service_record', $employee->slug);

    }




    public function serviceRecordDestroy($slug){

        $employee_sr = $this->employeeSrBySlug($slug);
        $employee_sr->delete();

        $this->event->fire('employee.service_record_destroy', $employee_sr);
        return redirect()->back();

    }













    // UTILITY METHODS

    public function employeeBySlug($slug){

        $employee = $this->cache->remember('employees:bySlug:' . $slug, 240, function() use ($slug){
            return $this->employee->findSlug($slug);
        });
        
        return $employee;

    }




    public function employeeSrBySlug($slug){

        $employee_sr = $this->cache->remember('employees:service_records:bySlug:' . $slug, 240, function() use ($slug){
            return $this->employee_sr->findSlug($slug);
        });

        return $employee_sr;

    }





    public function getFullname($request){

       return $request->firstname . " " . substr($request->middlename , 0, 1) . ". " . $request->lastname;

    }




     public function removeDependencies($employee){

        $employee->employeeAddress()->delete();
        $employee->employeeFamilyDetail()->delete();
        $employee->employeeOtherQuestion()->delete();
        $employee->employeeTraining()->delete();
        $employee->employeeChildren()->delete();
        $employee->employeeEducationalBackground()->delete();
        $employee->employeeEligibility()->delete();
        $employee->employeeExperience()->delete();
        $employee->employeeOrganization()->delete();
        $employee->employeeRecognition()->delete();
        $employee->employeeReference()->delete();
        $employee->employeeSpecialSkill()->delete();
        $employee->employeeVoluntaryWork()->delete();

     }




    public function fillDependencies($request, $employee){

        // Employee Family Details, Address, Other Questions
        $this->storeEmployeeFamilyDetails($request, $employee);
        $this->storeEmployeeAddress($request, $employee);
        $this->storeEmployeeOtherQuestions($request, $employee);

        // Employee Children
        if(count($request->row_children) > 0){
            foreach ($request->row_children as $row) {
                $this->storeEmployeeChildren($row, $employee);
            }
        }

        // Employee Educational Background
        if(count($request->row_eb) > 0){
            foreach ($request->row_eb as $row) {
                $this->storeEmployeeEducationalBackground($row, $employee);
            }
        }

        // Employee Training
        if(count($request->row_training) > 0){
            foreach ($request->row_training as $row) {
                $this->storeEmployeeTraining($row, $employee);
            }
        }

        // Employee Eligibility
        if(count($request->row_eligibility) > 0){
            foreach ($request->row_eligibility as $row) {
                $this->storeEmployeeEligibility($row, $employee);
            }
        }

        // Employee Work Experience
        if(count($request->row_we) > 0){
            foreach ($request->row_we as $row) {
                $this->storeEmployeeWorkExperience($row, $employee);
            }
        }

        // Employee Voluntary Works
        if(count($request->row_vw) > 0){
            foreach ($request->row_vw as $row) {
                $this->storeEmployeeVoluntaryWork($row, $employee);
            }
        }

        // Employee Recognition
        if(count($request->row_recognition) > 0){
            foreach ($request->row_recognition as $row) {
                $this->storeEmployeeRecognition($row, $employee);
            }
        }

        // Employee Organization
        if(count($request->row_org) > 0){
            foreach ($request->row_org as $row) {
                $this->storeEmployeeOrganization($row, $employee);
            }
        }

        // Employee Special Skills
        if(count($request->row_ss) > 0){
            foreach ($request->row_ss as $row) {
                $this->storeEmployeeSpecialSkill($row, $employee);
            }
        }

        // Employee Reference
        if(count($request->row_reference) > 0){
            foreach ($request->row_reference as $row) {
                $this->storeEmployeeReference($row, $employee);
            }
        }


    }






    public function storeEmployeeFamilyDetails($request, $employee){

        $employee_family_details = new EmployeeFamilyDetail;
        $employee_family_details->employee_no = $employee->employee_no;
        $employee_family_details->spouse_lastname = $request->spouse_lastname;
        $employee_family_details->spouse_firstname = $request->spouse_firstname;
        $employee_family_details->spouse_middlename = $request->spouse_middlename;
        $employee_family_details->spouse_name_ext = $request->spouse_name_ext;
        $employee_family_details->spouse_occupation = $request->spouse_occupation;
        $employee_family_details->spouse_employer = $request->spouse_employer;
        $employee_family_details->spouse_business_address = $request->spouse_business_address;
        $employee_family_details->spouse_tel_no = $request->spouse_tel_no;
        $employee_family_details->father_lastname = $request->father_lastname;
        $employee_family_details->father_firstname = $request->father_firstname;
        $employee_family_details->father_middlename = $request->father_middlename;
        $employee_family_details->father_name_ext = $request->father_name_ext;
        $employee_family_details->mother_lastname = $request->mother_lastname;
        $employee_family_details->mother_firstname = $request->mother_firstname;
        $employee_family_details->mother_middlename = $request->mother_middlename;
        $employee_family_details->mother_name_ext = $request->mother_name_ext;
        $employee_family_details->save();
        
    }






    public function storeEmployeeAddress($request, $employee){

        $employee_address = new EmployeeAddress;
        $employee_address->employee_no = $employee->employee_no;
        $employee_address->res_address_block = $request->res_address_block;
        $employee_address->res_address_street = $request->res_address_street;
        $employee_address->res_address_village = $request->res_address_village;
        $employee_address->res_address_barangay = $request->res_address_barangay;
        $employee_address->res_address_city = $request->res_address_city;
        $employee_address->res_address_province = $request->res_address_province;
        $employee_address->res_address_zipcode = $request->res_address_zipcode;
        $employee_address->perm_address_block = $request->perm_address_block;
        $employee_address->perm_address_street = $request->perm_address_street;
        $employee_address->perm_address_village = $request->perm_address_village;
        $employee_address->perm_address_barangay = $request->perm_address_barangay;
        $employee_address->perm_address_city = $request->perm_address_city;
        $employee_address->perm_address_province = $request->perm_address_province;
        $employee_address->perm_address_zipcode = $request->perm_address_zipcode;
        $employee_address->save();
        
    }






    public function storeEmployeeOtherQuestions($request, $employee){

        $employee_oq = new EmployeeOtherQuestion;
        $employee_oq->employee_no = $employee->employee_no;
        $employee_oq->q_34_a = $this->dataTypeHelper->string_to_boolean($request->q_34_a);
        $employee_oq->q_34_b = $this->dataTypeHelper->string_to_boolean($request->q_34_b);
        $employee_oq->q_34_b_yes_details = $request->q_34_b_yes_details;
        $employee_oq->q_35_a = $this->dataTypeHelper->string_to_boolean($request->q_35_a);
        $employee_oq->q_35_a_yes_details = $request->q_35_a_yes_details;
        $employee_oq->q_35_b = $this->dataTypeHelper->string_to_boolean($request->q_35_b);
        $employee_oq->q_35_b_yes_details_1 = $request->q_35_b_yes_details_1;
        $employee_oq->q_35_b_yes_details_2 = $request->q_35_b_yes_details_2;
        $employee_oq->q_36 = $this->dataTypeHelper->string_to_boolean($request->q_36);
        $employee_oq->q_36_yes_details = $request->q_36_yes_details;
        $employee_oq->q_37 = $this->dataTypeHelper->string_to_boolean($request->q_37);
        $employee_oq->q_37_yes_details = $request->q_37_yes_details;
        $employee_oq->q_38_a = $this->dataTypeHelper->string_to_boolean($request->q_38_a);
        $employee_oq->q_38_a_yes_details = $request->q_38_a_yes_details;
        $employee_oq->q_38_b = $this->dataTypeHelper->string_to_boolean($request->q_38_b);
        $employee_oq->q_38_b_yes_details = $request->q_38_b_yes_details;
        $employee_oq->q_39 = $this->dataTypeHelper->string_to_boolean($request->q_39);
        $employee_oq->q_39_yes_details = $request->q_39_yes_details;
        $employee_oq->q_40_a = $this->dataTypeHelper->string_to_boolean($request->q_40_a);
        $employee_oq->q_40_a_yes_details = $request->q_40_a_yes_details;
        $employee_oq->q_40_b = $this->dataTypeHelper->string_to_boolean($request->q_40_b);
        $employee_oq->q_40_b_yes_details = $request->q_40_b_yes_details;
        $employee_oq->q_40_c = $this->dataTypeHelper->string_to_boolean($request->q_40_c);
        $employee_oq->q_40_c_yes_details = $request->q_40_c_yes_details;
        $employee_oq->save();
        
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

        $employee_we = new EmployeeExperience;
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