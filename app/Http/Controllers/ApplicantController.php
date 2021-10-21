<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Course;
use App\Models\DepartmentUnit;
use App\Models\Document;
use App\Swep\Helpers\__sanitize;
use App\Swep\Services\ApplicantService;
use App\Http\Requests\Applicant\ApplicantFormRequest;
use App\Http\Requests\Applicant\ApplicantFilterRequest;
use App\Http\Requests\Applicant\ApplicantReportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ApplicantController extends Controller{



	protected $applicant;



    public function __construct(ApplicantService $applicant){

        $this->applicant = $applicant;

    }




	public function create(){

        return view('dashboard.applicant.create');

    }




	public function store(ApplicantFormRequest $request){

		return $this->applicant->store($request);

    }




	public function index(ApplicantFilterRequest $request){

		return $this->applicant->fetch($request);

    }




	public function show($slug){

		return $this->applicant->show($slug);

    }




	public function edit($slug){

		return $this->applicant->edit($slug);

    }




	public function update(ApplicantFormRequest $request, $slug){

		return $this->applicant->update($request, $slug);

    }




	public function destroy($slug){

		return $this->applicant->destroy($slug);

    }




	public function report(){

		return view('dashboard.applicant.report')->with(['columns' => $this->report_columns()]);

    }




	public function reportGenerate(Request $request){
        $activity = activity()
            ->performedOn(new Applicant())
            ->causedBy(Auth::user()->id)
            ->withProperties(['attributes' => 'Generated report on Applicants.'])
            ->log('generated');

        $applicants_db = Applicant::with(['course','departmentUnit','positionApplied'])->orderBy('lastname','asc');
        $filters = [];
        if($request->course != '' || !empty($request->course)){
            $applicants_db = $applicants_db->where('course_id',$request->course);
            $course_db = Course::where('course_id',$request->course)->first();
            if(!empty($course_db)){
                $filters['COURSE'] = $course_db->name;
            }else{
                $filters['COURSE'] = 'Course not found';
            }

        }

        if($request->has('date_range')){
            $date_range = __sanitize::date_range($request->date_range);
            $applicants_db = $applicants_db->whereBetween('received_at',$date_range);
        }

        if($request->unit_applied != '' || !empty($request->unit_applied)){
            $applicants_db = $applicants_db->where('department_unit_id',$request->unit_applied);
            $unit_db = DepartmentUnit::where('department_unit_id',$request->unit_applied)->first();
            if(!empty($course_db)){
                $filters['UNIT APPLIED'] = $unit_db->description;
            }else{
                $filters['UNIT APPLIED'] = 'Course not found';
            }

        }

        if($request->position_applied != '' || !empty($request->position_applied)){
            $position_applied = $request->position_applied;
            $applicants_db = $applicants_db->whereHas('positionApplied',function ($query) use($position_applied){
               return $query->where('position_applied',$position_applied);
            });
            $filters['POSITION APPLIED'] = $request->position_applied;
        }

        $applicants_db = $applicants_db->get();
        $applicants = [];
        if($request->layout == 'all'){
            foreach ($applicants_db as $applicant_db){
                $applicants['ALL APPLICANTS'][$applicant_db->slug] = ['applicant_obj' => $applicant_db];
                $applicants['ALL APPLICANTS']['label'] = 'ALL APPLICANTS';
            }
        }

        if($request->layout == 'by_course'){
            foreach ($applicants_db as $applicant_db){
                $applicants[$applicant_db->course_id][$applicant_db->slug] = ['applicant_obj' => $applicant_db];
                $applicants[$applicant_db->course_id]['label'] = $applicant_db->course->name;
            }
        }

        if($request->layout == 'by_unit'){
            foreach ($applicants_db as $applicant_db){

                if(!empty($applicant_db->departmentUnit)){
                    $applicants[$applicant_db->department_unit_id]['label'] = $applicant_db->departmentUnit->description;
                    $applicants[$applicant_db->department_unit_id][$applicant_db->slug] = ['applicant_obj' => $applicant_db];
                }else{
                    $applicants['NULL']['label'] = 'No Unit Stated';
                    $applicants['NULL'][$applicant_db->slug] = ['applicant_obj' => $applicant_db];
                }
            }
        }


        if($request->layout == 'by_position_applied'){
            foreach ($applicants_db as $applicant_db){
                foreach ($applicant_db->positionApplied as $position_applied){

                    $applicants[$position_applied->position_applied][$applicant_db->slug] = ['applicant_obj'=>$applicant_db];
                    $applicants[$position_applied->position_applied]['label'] = $position_applied->position_applied;
                }
            }

        }

        ksort($applicants);

        return view('printables.applicant.report_3')->with([
            'grouped_applicants' => $applicants,
            'columns' => $this->report_columns(),
            'requested_columns' => $request->columns,
            'request' => $request,
            'filters' => $filters,
        ]);
		return $this->applicant->reportGenerate($request);

    }




	public function addToShortList($slug){

		return $this->applicant->addToShortList($slug);

    }




	public function removeToShortList($slug){

		return $this->applicant->removeToShortList($slug);

    }


    
    private function report_columns(){
        return [
            'numbering' => 'Numbering',
            'received_at' => 'Date of Application',
            'fullname' => 'Fullname',
            'course' => 'Course',
            'department_unit' => 'Unit Applied',
            'gender' => 'Gender',
            'date_of_birth' => 'Date of Birth',
            'civil_status' => 'Civil Status',
            'address' => 'Address',
            'contact_no' => 'Contact #',
            'school' => 'School',
            'remarks' => 'Remarks',
            'position_applied' => 'Position Applied',
        ];
    }

    
}
