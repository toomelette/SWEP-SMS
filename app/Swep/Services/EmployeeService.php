<?php
 
namespace App\Swep\Services;

use App\Swep\Interfaces\EmployeeInterface;
use App\Swep\Interfaces\EmployeeFamilyDetailInterface;
use App\Swep\Interfaces\EmployeeAddressInterface;
use App\Swep\Interfaces\EmployeeOtherQuestionInterface;
use App\Swep\Interfaces\EmployeeChildrenInterface;
use App\Swep\Interfaces\EmployeeEducationalBackgroundInterface;
use App\Swep\Interfaces\EmployeeEligibilityInterface;
use App\Swep\Interfaces\EmployeeExperienceInterface;
use App\Swep\Interfaces\EmployeeVoluntaryWorkInterface;
use App\Swep\Interfaces\EmployeeRecognitionInterface;
use App\Swep\Interfaces\EmployeeOrganizationInterface;
use App\Swep\Interfaces\EmployeeSpecialSkillInterface;
use App\Swep\Interfaces\EmployeeReferenceInterface;

use App\Swep\BaseClasses\BaseService;




class EmployeeService extends BaseService{





    protected $employee_repo;
    protected $employee_fam_dtls_repo;
    protected $employee_address_repo;
    protected $employee_oq_repo;
    protected $employee_children_repo;
    protected $employee_eb_repo;
    protected $employee_elig_repo;
    protected $employee_exp_repo;
    protected $employee_vw_repo;
    protected $employee_recog_repo;
    protected $employee_org_repo;
    protected $employee_ss_repo;
    protected $employee_ref_repo;





    public function __construct(EmployeeInterface $employee_repo, EmployeeFamilyDetailInterface $employee_fam_dtls_repo, EmployeeAddressInterface $employee_address_repo, EmployeeOtherQuestionInterface $employee_oq_repo, EmployeeChildrenInterface $employee_children_repo, EmployeeEducationalBackgroundInterface $employee_eb_repo, EmployeeEligibilityInterface $employee_elig_repo, EmployeeExperienceInterface $employee_exp_repo, EmployeeVoluntaryWorkInterface $employee_vw_repo, EmployeeRecognitionInterface $employee_recog_repo, EmployeeOrganizationInterface $employee_org_repo, EmployeeSpecialSkillInterface $employee_ss_repo, EmployeeReferenceInterface $employee_ref_repo){

        $this->employee_repo = $employee_repo;
        $this->employee_fam_dtls_repo = $employee_fam_dtls_repo;
        $this->employee_address_repo = $employee_address_repo;
        $this->employee_oq_repo = $employee_oq_repo;
        $this->employee_children_repo = $employee_children_repo;
        $this->employee_eb_repo = $employee_eb_repo;
        $this->employee_elig_repo = $employee_elig_repo;
        $this->employee_exp_repo = $employee_exp_repo;
        $this->employee_vw_repo = $employee_vw_repo;
        $this->employee_recog_repo = $employee_recog_repo;
        $this->employee_org_repo = $employee_org_repo;
        $this->employee_ss_repo = $employee_ss_repo;
        $this->employee_ref_repo = $employee_ref_repo;
        parent::__construct();

    }








    public function fetchAll($request){

        $employees = $this->employee_repo->fetchAll($request);

        $request->flash();
        return view('dashboard.employee.index')->with('employees', $employees);
        
    }






    public function store($request){

        $employee = $this->employee_repo->store($request);
        $this->fillDependencies($request, $employee);

        $this->event->fire('employee.store');
        return redirect()->back();

    }






     public function show($slug){

        $employee = $this->employee_repo->findBySlug($slug);
        return view('dashboard.employee.show')->with('employee', $employee);

    }






    public function edit($slug){

        $employee = $this->employee_repo->findBySlug($slug);
        return view('dashboard.employee.edit')->with('employee', $employee);

    }





    public function update($request, $slug){
        
        $employee = $this->employee_repo->update($request, $slug);
        $this->fillDependencies($request, $employee);

        $this->event->fire('employee.update', $employee);
        return redirect()->route('dashboard.employee.index');

    }






    public function destroy($slug){

        $employee = $this->employee_repo->destroy($slug);

        $this->event->fire('employee.destroy', $employee);
        return redirect()->route('dashboard.employee.index');

    }






    public function printPDS($slug, $page){

        $employee = $this->employee_repo->findBySlug($slug);

        if($page == 'p1'){
            return view('printables.employee_pds_p1')->with('employee', $employee);
        }elseif($page == 'p2'){
            return view('printables.employee_pds_p2')->with('employee', $employee);
        }elseif($page == 'p3'){
            return view('printables.employee_pds_p3')->with('employee', $employee);
        }elseif($page == 'p4'){
            return view('printables.employee_pds_p4')->with('employee', $employee);
        }elseif($page == 'p5'){
            return view('printables.employee_pds_p5')->with('employee', $employee);
        }

        return abort(404);

    }






    public function printInfo($slug){

        $employee = $this->employee_repo->findBySlug($slug);
        return view('printables.employee_info')->with('employee', $employee);

    }







    public function fillDependencies($request, $employee){

        // Employee Family Details, Address, Other Questions
        $this->employee_fam_dtls_repo->store($request, $employee);
        $this->employee_address_repo->store($request, $employee);
        $this->employee_oq_repo->store($request, $employee);

        // Employee Children
        if(!empty($request->row_children)){
            foreach ($request->row_children as $row) {
                $this->employee_children_repo->store($row, $employee);
            }
        }

        // Employee Educational Background
        if(!empty($request->row_eb)){
            foreach ($request->row_eb as $row) {
                $this->employee_eb_repo->store($row, $employee);
            }
        }

        // Employee Eligibility
        if(!empty($request->row_eligibility)){
            foreach ($request->row_eligibility as $row) {
                $this->employee_elig_repo->store($row, $employee);
            }
        }

        // Employee Work Experience
        if(!empty($request->row_we)){
            foreach ($request->row_we as $row) {
                $this->employee_exp_repo->store($row, $employee);
            }
        }

        // Employee Voluntary Works
        if(!empty($request->row_vw)){
            foreach ($request->row_vw as $row) {
                $this->employee_vw_repo->store($row, $employee);
            }
        }

        // Employee Recognition
        if(!empty($request->row_recognition)){
            foreach ($request->row_recognition as $row) {
                $this->employee_recog_repo->store($row, $employee);
            }
        }

        // Employee Organization
        if(!empty($request->row_org)){
            foreach ($request->row_org as $row) {
                $this->employee_org_repo->store($row, $employee);
            }
        }

        // Employee Special Skills
        if(!empty($request->row_ss)){
            foreach ($request->row_ss as $row) {
                $this->employee_ss_repo->store($row, $employee);
            }
        }

        // Employee Reference
        if(!empty($request->row_reference)){
            foreach ($request->row_reference as $row) {
                $this->employee_ref_repo->store($row, $employee);
            }
        }


    }







}