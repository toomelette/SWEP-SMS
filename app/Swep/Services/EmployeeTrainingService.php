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

        $employee_trainings = $this->employee_trng_repo->fetchByEmployeeNo($slug);

        return view('dashboard.employee.training')->with($employee_trainings);

    }






    public function store($request, $slug){

        $employee_trng = $this->employee_trng_repo->store($request, $slug);

        return $employee_trng;

    }






    public function update($request, $slug){
        
        $employee_trng = $this->employee_trng_repo->update($request, $slug);
        return $employee_trng;
//        $this->event->fire('employee_training.update', $employee_trng);
//        return redirect()->route('dashboard.employee.training', $emp_slug);

    }






    public function destroy($slug){

        $employee_trng = $this->employee_trng_repo->destroy($slug);

        return $employee_trng;

    }






    public function print($request, $slug){

        $employee_trainings = $this->employee_trng_repo->getByEmployeeNoWithFilter($request, $slug);

        return view('printables.employee.training')->with($employee_trainings);

    }







}