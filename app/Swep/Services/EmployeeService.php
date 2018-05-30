<?php
 
namespace App\Swep\Services;


use App\Models\Employee;
use App\Models\EmployeeTraining;
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

        $rows = $request->row;

        $employee = new Employee;
        $employee->slug = $this->str->random(16);
        $employee->employee_id = $this->employee->employeeIdInc;
        $employee->department_id = $request->dept;
        $employee->department_unit_id = $request->division;
        $employee->empno = $request->empno;
        $employee->empname = strtoupper($request->lastname .', '. $request->firstname .' '. substr($request->middlename , 0, 1) .'.');
        $employee->lastname = $request->lastname;
        $employee->firstname = $request->firstname;
        $employee->middlename = $request->middlename;
        $employee->address = $request->address;
        $employee->dob = $this->dataTypeHelper->date_in($request->dob);
        $employee->pob = $request->pob;
        $employee->gender = $request->gender;
        $employee->bloodtype = $request->bloodtype;
        $employee->civilstat = $request->civilstat;
        $employee->undergrad = $request->undergrad;
        $employee->graduate1 = $request->graduate1;
        $employee->graduate2 = $request->graduate2;
        $employee->postgrad1 = $request->postgrad1;
        $employee->eligibility = $request->eligibility;
        $employee->eligibilitylevel = $request->eligibilitylevel;
        $employee->dept = $request->dept;
        $employee->division = $request->division;
        $employee->position = $request->position;
        $employee->salgrade = $request->salgrade;
        $employee->stepinc = $request->stepinc;
        $employee->apptstat = $request->apptstat;
        $employee->itemno = $request->itemno;
        $employee->monthlybasic = $this->dataTypeHelper->string_to_num($request->monthlybasic);
        $employee->aca = $this->dataTypeHelper->string_to_num($request->aca);
        $employee->pera = $this->dataTypeHelper->string_to_num($request->pera);
        $employee->foodsubsi = $this->dataTypeHelper->string_to_num($request->foodsubsi);
        $employee->allow1 = $this->dataTypeHelper->string_to_num($request->allow1);
        $employee->allow2 = $this->dataTypeHelper->string_to_num($request->allow2);
        $employee->govserv = $this->dataTypeHelper->date_in($request->govserv);
        $employee->firstday = $this->dataTypeHelper->date_in($request->firstday);
        $employee->apptdate = $this->dataTypeHelper->date_in($request->apptdate);
        $employee->adjdate = $this->dataTypeHelper->date_in($request->adjdate);
        $employee->phic = $request->phic;
        $employee->tin = $request->tin;
        $employee->hdmf = $request->hdmf;
        $employee->gsis = $request->gsis;
        $employee->active = $request->active;
        $employee->hdmfpremiums = $this->dataTypeHelper->string_to_num($request->hdmfpremiums);
        $employee->created_at = $this->carbon->now();
        $employee->updated_at = $this->carbon->now();
        $employee->ip_created = request()->ip();
        $employee->ip_updated = request()->ip();
        $employee->user_created = $this->auth->user()->username;
        $employee->user_updated = $this->auth->user()->username;
        $employee->save();

        if(count($rows) > 0){

            foreach ($rows as $row) {
                
                $et = new EmployeeTraining;
                $et->employee_id = $employee->employee_id;
                $et->empno = $employee->empno;
                $et->topics = $row['topics'];
                $et->conductedby = $row['conductedby'];
                $et->datefrom =  $this->dataTypeHelper->date_in($row['datefrom']);
                $et->dateto =  $this->dataTypeHelper->date_in($row['dateto']);
                $et->venue = $row['venue'];
                $et->hours = $row['hours'];
                $et->remarks = $row['remarks'];
                $et->save();

            }
        }

        $this->event->fire('employee.store');
        return redirect()->back();

    }





     public function show($slug){

        $employee = $this->employeeBySlug($slug);
        return view('dashboard.employee.show')->with('employee', $employee);

    }





    public function edit($slug){



    }






    public function update($request, $slug){



    }






    public function destroy($slug){


    }





    // Utility Methods

    public function employeeBySlug($slug){

        $employee = $this->cache->remember('employees:bySlug:' . $slug, 240, function() use ($slug){
            return $this->employee->findSlug($slug);
        });
        
        return $employee;

    }






}