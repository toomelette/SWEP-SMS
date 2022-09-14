<?php


namespace App\Http\Controllers;


use App\Models\Applicant;
use App\Models\ApplicantPositionApplied;
use App\Models\Course;
use App\Models\Document;
use App\Models\Employee;
use App\Models\HRPayPlanitilla;
use App\Models\SSL;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
    public function get($for){

        if($for == 'compute_monthly_salary'){
            $latest = SSL::query()->orderBy('date_implemented','desc')->first();
            $latest_date_implemented = $latest->date_implemented;
            $ssl = SSL::query()->where('salary_grade','=',Request::get('sg'))
                ->where('date_implemented','=',$latest_date_implemented)
                ->first();
            $si = 'step'.Request::get('si');

            if(!empty($ssl->$si)){
                return number_format($ssl->$si,2);
            }
            else{
                return 'N/A';
            }
        }
        if($for == 'educational_background'){
            return view('ajax.employee.add_school');
        }

        if($for == 'eligibility'){
            return view('ajax.employee.add_eligibility');
        }

        if($for == 'work_experience'){
            $rand = Str::random(16);
            return [
                'view' => view('ajax.employee.add_work_experience')->with([
                                'rand' => $rand,
                            ])->render(),
                'rand' => $rand,
            ];
        }

        if($for == 'close_bulletin'){
            $last_slug = request('last_slug');
            Session::put('last_slug',$last_slug);

            return Session::get('last_slug');
        }

        if($for == 'document_person_to'){
            $arr['results'] = [];
            $docs = Document::query()->select('person_to')->where('person_to','like','%'.Request::get("q").'%')->groupBy('person_to')->limit(30)->get();
            array_push($arr['results'],['id'=>'','text' => "Don't Filter"]);
            if(!empty($docs)){

                foreach ($docs as $doc){
                    array_push($arr['results'],['id'=>$doc->person_to,'text' => $doc->person_to]);
                }
            }
            return $arr;
        }
        if($for == 'document_person_from'){
            $arr['results'] = [];
            $docs = Document::query()->select('person_from')->where('person_from','like','%'.Request::get("q").'%')->groupBy('person_from')->limit(30)->get();
            array_push($arr['results'],['id'=>'','text' => "Don't Filter"]);
            if(!empty($docs)){
                foreach ($docs as $doc){
                    array_push($arr['results'],['id'=>$doc->person_from,'text' => $doc->person_from]);
                }
            }
            return $arr;
        }
        if($for == 'dv_add_item'){
            $rcs = \App\Models\RC::query()->get();
            $rand = \Illuminate\Support\Str::random(5);
            return [
                'view' => view('ajax.disbursement_voucher.add_item')->with([
                            'rcs'=>$rcs,
                            'rand' => $rand,
                        ])->render(),
                'rand' => $rand,
            ];
        }

        if($for == 'position_applied'){
            $arr = [];
            $pps = HRPayPlanitilla::query()->select('item_no','position')->get();
            foreach ($pps as $pp){
                array_push($arr,'ITEM '.$pp->item_no.' - '.$pp->position);
            }
            return $arr;
            //return ["Any Position","Accounting Staff","Clerk III","Laboratory Aide","Science Research Specialist II","Science Researcher","Laboratory Science Researcher","Office Clerk","Junior Agriculturist","Project Development Officer","Surveyor","SPRO","Farm Surveyor","Agriculturist","Project Evaluation Officer","Driver","Clerk","Electrician Foreman","Sugar Production Regulations Officer I","Cashier I","Sugar Production and Regulation Officer","Secretary II","Records Officer III","Sugar Production and Regulation Officer II","Property Custodian","Secretary I","Laboratory Technician II","Cashier","Sugar Regulation Officer II","Chief Finance Officer","Mechanical Engineer","Sugar Production Regulation Officer II","Procurement Officer","Accounting Officer","Senior Sugar Production Regulation Officer","Chemical Engineer","Chemist III","Chemical Technician","IT Specialist","SRA Technician","Accountant","Science Aide","Laborer II","Driver II","Utility Worker II","Utility Worker","Research Assistant","Administrative Officer","Position in Accounting","Heavy Equipment Operator","ACCOUNTANT IV","Administrative Position","Senior Science Research Specialist","Engineer III","Supply Officer II","Supply Officer III","Supply Officer IV"];
        }

        if($for == 'applicant_courses'){
            $arr['results'] = [];
            $courses = Course::query()->where('acronym','like','%'.Request::get("q").'%')
                ->orWhere('name','like','%'.Request::get("q").'%')
                ->groupBy('name')->limit(30)->get();
            array_push($arr['results'],['id'=>'','text' => "Select"]);
            if(!empty($courses)){
                foreach ($courses as $course){
                    array_push($arr['results'],['id'=>$course->name,'text' => $course->name]);
                }
            }
            return $arr;
        }

        if($for == 'search_active_employees'){

            if(Request::get('afterTypeahead') == true){
                $emp = Employee::query()
                    ->select('lastname','firstname','middlename','sex','date_of_birth','civil_status','cell_no')
                    ->where('slug','=',Request::get('id'))->first();

                return [
                    'lastname' => $emp->lastname,
                    'firstname' => $emp->firstname,
                    'middlename' => $emp->middlename,
                    'sex' => $emp->sex,
                    'date_of_birth' => Carbon::parse($emp->date_of_birth)->format('Y-m-d'),
                    'civil_status' => $emp->civil_status,
                    'cell_no' => $emp->cell_no,
                    'civil_status' => $emp->civil_status,
                ];
            }
            $arr = [];
            $find = Request::get('query');

            $emps = Employee::query()
                ->where(function ($query) use($find){
                    $query->where('lastname','like','%'.$find.'%')
                        ->orWhere('firstname','like','%'.$find.'%')
                        ->orWhere('middlename','like','%'.$find.'%');
                })
                ->limit(10)
                ->get();

            if(!empty($emps)){
                foreach ($emps as $emp){
                    array_push($arr,[
                        'id' => $emp->slug,
                        'name' => $emp->lastname.', '.$emp->firstname.' '.$emp->middlename,
                        'sex' => $emp->sex,
                    ]);
                }
            }

            return $arr;
        }

    }
}