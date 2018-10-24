<?php
 
namespace App\Swep\Services;


use App\Swep\Interfaces\EmployeeTrainingInterface;
use App\Swep\BaseClasses\BaseService;



class EmployeeTrainingService extends BaseService{

    protected $employee_trng_repo;



    public function __construct(EmployeeTrainingInterface $employee_trng_repo){

        $this->employee_trng_repo = $employee_trng_repo;
        parent::__construct();

    }





    public function index($slug){

        $employee_trainings = $this->employee_trng_repo->fetchByEmpNo($slug);

        return view('dashboard.employee.training')->with($employee_trainings);

    }






    public function store($request, $slug){

        $employee_trng = $this->employee_trng_repo->store($request, $slug);

        $this->event->fire('employee_training.store', $employee_trng);
        return redirect()->route('dashboard.employee.training', $slug);

    }






    public function update($request, $emp_slug, $emp_trng_slug){
        
        $employee_trng = $this->employee_trng_repo->update($request, $emp_slug, $emp_trng_slug);

        $this->event->fire('employee_training.update', $employee_trng);
        return redirect()->route('dashboard.employee.training', $emp_slug);

    }






    public function destroy($slug){

        $employee_trng = $this->employee_trng_repo->destroy($slug);

        $this->event->fire('employee_training.destroy', $employee_trng);
        return redirect()->back();

    }






    public function print($slug){

        $employee_trainings = $this->employee_trng_repo->fetchByEmpNo($slug);

        return view('printables.employee.training')->with($employee_trainings);

    }







}