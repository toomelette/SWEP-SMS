<?php

namespace App\Http\Controllers;


use App\Models\Applicant;
use App\Models\Course;
use App\Models\Document;
use App\Models\DocumentDisseminationLog;
use App\Models\EmailContact;
use App\Models\Employee;
use App\Models\LeaveApplication;
use App\Models\PermissionSlip;
use App\Swep\Services\HomeService;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller{
    



	protected $home;




    public function __construct(HomeService $home){

        $this->home = $home;

    }





    public function index(){
        if(Auth::user()->dash == 'hru'){
            $per_course = DB::table("swep_afd.hr_courses")
                ->leftJoin("hr_applicants", function($join){
                    $join->on("hr_courses.course_id", "=", "hr_applicants.course_id");
                })
                ->select("name", DB::raw('count(hr_applicants.slug) as count'))
                ->orderBy("name","asc")
                ->groupBy("name")
                ->get();

            $per_date_received = DB::table('hr_applicants')
                ->select('received_at', DB::raw("count('slug') as count"))
                ->where('received_at','!=', null)
                ->groupBy('received_at')
                ->orderBy('received_at','asc')
                ->get();

            $all_leave_applications = LeaveApplication::count();
            $all_ps = PermissionSlip::count();
            $male_employees = Employee::where('sex','MALE')->count();
            $female_employees = Employee::where('sex','FEMALE')->count();
            $all_employees = Employee::count();
            $all_applicants = Applicant::count();
            return view('dashboard.home.hru_index')->with([
                'male_employees' => $male_employees,
                'female_employees' => $female_employees,
                'all_employees' => $all_employees,
                'per_course' => $per_course,
                'per_date_received' => $per_date_received,
                'all_applicants' => $all_applicants,
                'all_leave_applications' => $all_leave_applications,
                'all_ps' => $all_ps,
            ]);
        }

        if(Auth::user()->dash == 'records'){

            $sent_by_week = DB::table('rec_document_dissemination_logs')
                ->select('sent_at', DB::raw("count('slug') as count"))
                ->where('status','sent')
                ->groupBy(DB::raw('week(sent_at)'))
                ->orderBy("sent_at","asc")
                ->get();
            $emails_per_contact = DocumentDisseminationLog::with(['emailContact','employee'])
                ->select('email_contact_id','employee_no',DB::raw('count(slug) as count'))
                ->groupBy('email_contact_id','employee_no')
                ->get();

            $documents_per_week = Document::select('reference_no','date',DB::raw('count(slug) as  "count"'))
                ->groupBy(DB::raw("week(date)"))
                ->orderBy('date','asc')
                ->get();


            return view('dashboard.home.records_index')->with([
                'all_documents' => Document::count(),
                'all_emails_sent' => DocumentDisseminationLog::where('status','sent')->count(),
                'all_contacts' => EmailContact::count(),
                'sent_by_week' => $sent_by_week,
                'emails_per_contact' => $emails_per_contact,
                'documents_per_week' => $documents_per_week,
            ]);
        }
    	return $this->home->view();
    }
    





}
