<?php

namespace App\Swep\Repositories;
 
use App\Swep\BaseClasses\BaseRepository;
use App\Swep\Interfaces\EmployeeInterface;


use App\Models\Employee;


class EmployeeRepository extends BaseRepository implements EmployeeInterface {
	



    protected $employee;




	public function __construct(Employee $employee){

        $this->employee = $employee;
        parent::__construct();

    }






    public function fetchAll($request){

        $key = str_slug($request->fullUrl(), '_');

        $employees = $this->cache->remember('employees:all:' . $key, 240, function() use ($request){

            $employee = $this->employee->newQuery();
            
            if(isset($request->q)){
                $this->search($employee, $request->q);
            }

            if(isset($request->d)){
                $employee->whereDepartmentId($request->d);
            }

            if(isset($request->a)){
                $employee->whereIsActive($request->a);
            }

            return $this->populate($employee);

        });

        return $employees;
        
    }






    public function fetchByDepartmentId($dept_id){

        $employees = $this->cache->remember('employees:byDepartmentId:' . $dept_id, 240, function() use ($dept_id){

            $employee = $this->employee->newQuery();

            return $employee->select('fullname')
                            ->where('department_id', $dept_id)
                            ->where('is_active', 'ACTIVE')
                            ->with('permissionSlip')
                            ->get();

        });

        return $employees;
        
    }






    public function fetchByIsActive($status){

        $employees = $this->cache->remember('employees:byIsActive:' . $status, 240, function() use ($status){

            $employee = $this->employee->newQuery();

            return $employee->select('employee_no', 'fullname', 'position', 'department_id')
                            ->where('is_active', $status)
                            ->with('leaveCard', 'department')
                            ->orderBy('lastname', 'ASC')
                            ->get();

        });

        return $employees;
        
    }






    public function store($request){

        $employee = new Employee;
        $employee->slug = $this->str->random(16);
        $employee->project_id = $request->project_id;
        $employee->department_id = $request->department_id;
        $employee->department_unit_id = $request->department_unit_id;
        $employee->employee_no = $request->employee_no;
        $employee->lastname = $request->lastname;
        $employee->firstname = $request->firstname;
        $employee->middlename = $request->middlename;
        $employee->name_ext = $request->name_ext;
        $employee->fullname = $this->getRequestFullname($request);
        $employee->date_of_birth = $this->__dataType->date_parse($request->date_of_birth);
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
        $employee->hdmfpremiums = $this->__dataType->string_to_num($request->hdmfpremiums);
        $employee->appointment_status = $request->appointment_status;
        $employee->position = $request->position;
        $employee->item_no = $request->item_no;
        $employee->salary_grade = $request->salary_grade;
        $employee->step_inc = $request->step_inc;
        $employee->monthly_basic = $this->__dataType->string_to_num($request->monthly_basic);
        $employee->aca = $this->__dataType->string_to_num($request->aca);
        $employee->pera = $this->__dataType->string_to_num($request->pera);
        $employee->food_subsidy = $this->__dataType->string_to_num($request->food_subsidy);
        $employee->ra = $this->__dataType->string_to_num($request->ra);
        $employee->ta = $this->__dataType->string_to_num($request->ta);
        $employee->firstday_gov = $this->__dataType->date_parse($request->firstday_gov);
        $employee->firstday_sra = $this->__dataType->date_parse($request->firstday_sra);
        $employee->appointment_date = $this->__dataType->date_parse($request->appointment_date);
        $employee->adjustment_date = $this->__dataType->date_parse($request->adjustment_date);
        $employee->is_active = $request->is_active;
        $employee->created_at = $this->carbon->now();
        $employee->updated_at = $this->carbon->now();
        $employee->ip_created = request()->ip();
        $employee->ip_updated = request()->ip();
        $employee->user_created = $this->auth->user()->user_id;
        $employee->user_updated = $this->auth->user()->user_id;
        $employee->save();

        return $employee;

    }






    public function update($request, $slug){

        $employee = $this->findBySlug($slug);
        $employee->project_id = $request->project_id;
        $employee->department_id = $request->department_id;
        $employee->department_unit_id = $request->department_unit_id;
        $employee->employee_no = $request->employee_no;
        $employee->lastname = $request->lastname;
        $employee->firstname = $request->firstname;
        $employee->middlename = $request->middlename;
        $employee->name_ext = $request->name_ext;
        $employee->fullname = $this->getRequestFullname($request);
        $employee->date_of_birth = $this->__dataType->date_parse($request->date_of_birth);
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
        $employee->hdmfpremiums = $this->__dataType->string_to_num($request->hdmfpremiums);
        $employee->appointment_status = $request->appointment_status;
        $employee->position = $request->position;
        $employee->item_no = $request->item_no;
        $employee->salary_grade = $request->salary_grade;
        $employee->step_inc = $request->step_inc;
        $employee->monthly_basic = $this->__dataType->string_to_num($request->monthly_basic);
        $employee->aca = $this->__dataType->string_to_num($request->aca);
        $employee->pera = $this->__dataType->string_to_num($request->pera);
        $employee->food_subsidy = $this->__dataType->string_to_num($request->food_subsidy);
        $employee->ra = $this->__dataType->string_to_num($request->ra);
        $employee->ta = $this->__dataType->string_to_num($request->ta);
        $employee->firstday_gov = $this->__dataType->date_parse($request->firstday_gov);
        $employee->firstday_sra = $this->__dataType->date_parse($request->firstday_sra);
        $employee->appointment_date = $this->__dataType->date_parse($request->appointment_date);
        $employee->adjustment_date = $this->__dataType->date_parse($request->adjustment_date);
        $employee->is_active = $request->is_active;
        $employee->updated_at = $this->carbon->now();
        $employee->ip_updated = request()->ip();
        $employee->user_updated = $this->auth->user()->user_id;
        $employee->save();

        $this->destroyDependencies($employee);

        return $employee; 

    }






    public function destroy($slug){

        $employee = $this->findBySlug($slug);
        $employee->delete();
        $employee->employeeServiceRecord()->delete();
        
        $this->destroyDependencies($employee);

        return $employee;

    }






    public function destroyDependencies($employee){

        $employee->employeeAddress()->delete();
        $employee->employeeFamilyDetail()->delete();
        $employee->employeeOtherQuestion()->delete();
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






    public function findBySlug($slug){

        $employee = $this->cache->remember('employees:bySlug:' . $slug, 240, function() use ($slug){
            return $this->employee->where('slug', $slug)
                                  ->with('EmployeeAddress',
                                         'EmployeeFamilyDetail',
                                         'EmployeeOtherQuestion',
                                         'employeeTraining', 
                                         'employeeChildren', 
                                         'employeeEducationalBackground', 
                                         'employeeEligibility',
                                         'employeeExperience',
                                         'employeeOrganization',
                                         'employeeRecognition',
                                         'employeeReference',
                                         'employeeSpecialSkill',
                                         'employeeVoluntaryWork',
                                         'employeeServiceRecord')
                                    ->first();
        });
        
        if(empty($employee)){
            abort(404);
        }

        return $employee;

    }






    public function findByUserId($user_id){

        $employee = $this->cache->remember('employees:byUserId:' . $user_id, 240, function() use ($user_id){
            return $this->employee->where('user_id', $user_id)->first();
        });

        if(empty($employee)){
            abort(404);
        }

        return $employee;

    }






    public function search($model, $key){

        return $model->where(function ($model) use ($key) {
                $model->where('employee_no', 'LIKE', '%'. $key .'%')
                      ->orwhere('lastname', 'LIKE', '%'. $key .'%')
                      ->orwhere('firstname', 'LIKE', '%'. $key .'%')
                      ->orwhere('fullname', 'LIKE', '%'. $key .'%')
                      ->orwhere('employee_no', 'LIKE', '%'. $key .'%');
        });

    }





    public function populate($model){

        return $model->select('employee_no', 'fullname', 'position', 'slug')
                     ->sortable()
                     ->orderBy('updated_at', 'desc')
                     ->paginate(10);

    }





    public function getRequestFullname($request){

       return $request->firstname . " " . substr($request->middlename , 0, 1) . ". " . $request->lastname;

    }





    public function globalFetchAll(){

        $employees = $this->cache->remember('employees:global:all', 240, function(){
            return $this->employee->select('slug', 'employee_no', 'fullname')
                                  ->where('is_active', 'ACTIVE')
                                  ->get();
        });
        
        return $employees;

    }





    public function apiGetBySlug($slug){

        $employee = $this->cache->remember('api:employees:bySlug:'. $key .'', 240, function() use ($key){
            return $this->employee->where('slug', $key)->get();
        });

        return $employee;

    }






}