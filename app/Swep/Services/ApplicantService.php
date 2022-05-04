<?php
 
namespace App\Swep\Services;


use App\Models\Applicant;
use App\Models\ApplicantPositionApplied;
use App\Swep\Interfaces\ApplicantInterface;
use App\Swep\Interfaces\CourseInterface;
use App\Swep\Interfaces\DepartmentUnitInterface;
use App\Swep\BaseClasses\BaseService;



class ApplicantService extends BaseService{



    protected $applicant_repo;
    protected $course_repo;
    protected $dept_unit_repo;



    public function __construct(ApplicantInterface $applicant_repo, CourseInterface $course_repo, DepartmentUnitInterface $dept_unit_repo){

        $this->applicant_repo = $applicant_repo;
        $this->course_repo = $course_repo;
        $this->dept_unit_repo = $dept_unit_repo;
        parent::__construct();

    }





    public function fetch($request){

        $applicants = $this->applicant_repo->fetch($request);

        $request->flash();
        return view('dashboard.applicant.index')->with('applicants', $applicants);

    }






    public function store($request){

        $applicant = $this->applicant_repo->store($request);
        $this->fillDependencies($request, $applicant);

//        $this->event->dispatch('applicant.store', $applicant);
        return redirect()->back();

    }






    public function show($slug){

        $applicant = $this->applicant_repo->findBySlug($slug);
        return view('dashboard.applicant.show')->with('applicant', $applicant);

    }






    public function edit($slug){

        $applicant = $this->applicant_repo->findBySlug($slug);
        return view('dashboard.applicant.edit')->with('applicant', $applicant);

    }





    public function update($request, $slug){

        $applicant = $this->applicant_repo->update($request, $slug);
        $this->fillDependencies($request, $applicant);

//        $this->event->dispatch('applicant.update', $applicant);
        return redirect()->route('dashboard.applicant.index');

    }





    public function destroy($slug){

        $applicant = $this->applicant_repo->destroy($slug);

//        $this->event->dispatch('applicant.destroy', $applicant );
        return redirect()->back();

    }





    public function reportGenerate($request){

        $applicants = [];

        $course = [];

        if($request->r_type == "ABC"){

            $course = $this->course_repo->findByCourseId($request->c);
            
            if ($request->lt == "FL") {
                
                $applicants = $this->applicant_repo->getByCourseId($request->c);
            
            }elseif($request->lt == "SL"){
                
                $applicants = $this->applicant_repo->getByCourseIdShortlist($request->c);

            }

            return view('printables.applicant.report_1', compact('course', 'applicants'));

        }elseif ($request->r_type == "ABU") {

            $dept_unit = $this->dept_unit_repo->findByDeptUnitId($request->du);
            
            if ($request->lt == "FL") {
            
                $applicants =$this->applicant_repo->getByDeptUnitId($request->du);
            
            }elseif($request->lt == "SL"){
            
                $applicants =$this->applicant_repo->getByDeptUnitIdShortlist($request->du);

            }

            return view('printables.applicant.report_1', compact('dept_unit', 'applicants'));

        }elseif ($request->r_type == "ABD") {
            $from = date("Ymd",strtotime($request->from));
            $to = date("Ymd",strtotime($request->to));
            $applicants = $this->applicant_repo->getByDate($from,$to, $request->lt);
            
            return view('printables.applicant.report_1')->with('applicants', $applicants);

        }elseif($request->r_type == "ABP"){
            $applicants_array = [];
            if($request->lt == 'All'){
                $applicants = ApplicantPositionApplied::with('applicant')->orderBy('position_applied','asc')->get();
            }else{
                $applicants = ApplicantPositionApplied::with('applicant')->where('position_applied',$request->lt)->orderBy('position_applied','asc')->get();
            }
            foreach ($applicants as $applicant){
                $applicants_array[$applicant->position_applied][$applicant->applicant_slug] = $applicant;
            }
            //print('<pre>'.print_r($applicants_array,true).'</pre>');
            return view('printables.applicant.report_2')->with('positions', $applicants_array);
        }else{

           abort(404); 

        }

    }





    public function addToShortList($slug){

        $applicant = $this->applicant_repo->addToShortList($slug);

//        $this->event->dispatch('applicant.add_to_shortist', $applicant);
        return redirect()->back();

    }





    public function removeToShortList($slug){

        $applicant = $this->applicant_repo->removeToShortList($slug);

//        $this->event->dispatch('applicant.remove_to_shortist', $applicant);
        return redirect()->back();

    }





    // Utils
    private function fillDependencies($request, $applicant){

        // Applicant Training
        if(!empty($request->row_training)){
            foreach ($request->row_training as $row) {
                $this->applicant_repo->storeTrainings($row, $applicant);
            }
        }

        // Applicant Experience
        if(!empty($request->row_exp)){
            foreach ($request->row_exp as $row) {
                $this->applicant_repo->storeExperience($row, $applicant);
            }
        }

        // Applicant Educational Background
        if(!empty($request->row_edc_background)){
            foreach ($request->row_edc_background as $row) {
                $this->applicant_repo->storeEducationalBackground($row, $applicant);
            }
        }

        // Applicant Eligibility
        if(!empty($request->row_elig)){
            foreach ($request->row_elig as $row) {
                $this->applicant_repo->storeEligibilities($row, $applicant);
            }
        }

        //Applicant Position Applied
        if(!empty($request->position_applied)){
            $position_applied_string = $request->position_applied;
            $position_applied_array = explode(',',$position_applied_string);

            foreach ($position_applied_array as $position_applied){
                $this->applicant_repo->storePositionApplied($position_applied,$applicant->slug);
            }
        }

    }






}