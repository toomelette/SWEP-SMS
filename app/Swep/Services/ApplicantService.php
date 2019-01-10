<?php
 
namespace App\Swep\Services;


use App\Swep\Interfaces\ApplicantInterface;
use App\Swep\BaseClasses\BaseService;



class ApplicantService extends BaseService{



    protected $applicant_repo;



    public function __construct(ApplicantInterface $applicant_repo){

        $this->applicant_repo = $applicant_repo;
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

        $this->event->fire('applicant.store', $applicant);
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

        $this->event->fire('applicant.update', $applicant);
        return redirect()->route('dashboard.applicant.index');

    }





    public function destroy($slug){

        $applicant = $this->applicant_repo->destroy($slug);

        $this->event->fire('applicant.destroy', $applicant );
        return redirect()->route('dashboard.applicant.index');

    }





    public function reportGenerate($request){


        if($request->r_type == "ABC"){

            $applicants = $this->applicant_repo->getByCourseId($request->c); 
            return view('printables.applicant.by_course')->with('applicants', $applicants);

        }


        if ($request->r_type == "ABU") {
            
            $applicants =$this->applicant_repo->getByDeptUnitId($request->du); 
            return view('printables.applicant.by_dept_unit')->with('applicants', $applicants);

        }

        abort(404);

    }







    public function fillDependencies($request, $applicant){

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

    }






}