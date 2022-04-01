<?php

namespace App\Http\Controllers;


use App\Models\Applicant;
use App\Models\Course;
use App\Models\Document;
use App\Models\DocumentDisseminationLog;
use App\Models\EmailContact;
use App\Models\Employee;
use App\Models\JoEmployees;
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

    private function birthdayCelebrantsView($this_month){

//        $perm = DB::table('hr_employees')
//            ->select('lastname','firstname','middlename','date_of_birth as birthday',DB::raw("LPAD(MONTH(date_of_birth),2,'0') as month_bday"), DB::raw("'PERM' as type") ,'employee_no')
//            ->where(DB::raw("LPAD(MONTH(date_of_birth),2,'0')") , '=',$this_month)
//            ->where('is_active' ,'=','ACTIVE');
//        $jo = DB::table('hr_jo_employees')
//            ->select('lastname','firstname','middlename','birthday',DB::raw("LPAD(MONTH(birthday),2,'0') as month_bday"), DB::raw("'COS' as type"),'employee_no')
//            ->where(DB::raw("LPAD(MONTH(birthday),2,'0')") , '=',$this_month);
        $union = Employee::query()
            ->select('lastname','firstname','middlename','date_of_birth as birthday',DB::raw("LPAD(MONTH(date_of_birth),2,'0') as month_bday"), DB::raw("'PERM' as type") ,'employee_no')
            ->where(DB::raw("LPAD(MONTH(date_of_birth),2,'0')") , '=',$this_month)
            ->where('is_active','=','ACTIVE')->get();
        $bday_celebrants = [];
        $bday_celebrants['prev'] = [];
        $bday_celebrants['upcoming'] = [];
        $bday_celebrants['today'] = [];
        foreach ($union as $emp) {
            if(Carbon::parse($emp->birthday)->format('md') < Carbon::now()->format('md')){
                $bday_celebrants['prev'][Carbon::parse($emp->birthday)->format('md')][$emp->employee_no] = $emp;
            }elseif(Carbon::parse($emp->birthday)->format('md') == Carbon::now()->format('md')){
                $bday_celebrants['today'][Carbon::parse($emp->birthday)->format('md')][$emp->employee_no] = $emp;
            }else{
                $bday_celebrants['upcoming'][Carbon::parse($emp->birthday)->format('md')][$emp->employee_no] = $emp;
            }
        }
        krsort($bday_celebrants['prev']);
        ksort($bday_celebrants['upcoming']);
        return view('dashboard.home.birthday_celebrants')->with([
            'bday_celebrants' => $bday_celebrants,
        ])->render();
    }
    private  function stepIncrements($month,$year = null){
        if($year == ''){
            $year = Carbon::now()->format('Y');
        }
        $emps = Employee::query()->where('adjustment_date','!=',null)
            ->where('is_active','=','ACTIVE')
            ->whereMonth('adjustment_date','=',$month)
            ->get();
        $employees_with_adjustments = [];
        foreach ($emps as $emp){
            $diff = ($year)-(Carbon::parse($emp->adjustment_date)->format('Y'));
            if($diff%3 == 0){
                $employees_with_adjustments[$emp->slug] = $emp;
            }
        }

        return view('dashboard.home.step_increments')->with([
            'employees_with_adjustments' => $employees_with_adjustments,
            'year_step' => $year
        ])->render();
    }
    public function index(){
        if(Auth::user()->dash == 'hru'){


            if(request()->ajax() && request()->has('bday')){
                $new_next = str_pad(request('month')+1,2,0,STR_PAD_LEFT);
                $new_prev = str_pad(request('month')-1,2,0,STR_PAD_LEFT);
                if($new_next > 12){
                    $new_next = '01';
                }
                if($new_prev < 1){
                    $new_prev = 12;
                }
                return [
                    'view' => $this->birthdayCelebrantsView(request('month')),
                    'new_next' => $new_next,
                    'new_prev' => $new_prev,
                    'new_current' => str_pad(request('month'),2,0,STR_PAD_LEFT),
                    'month_name' => Carbon::parse('2021'.str_pad(request('month'),2,0,STR_PAD_LEFT).'01')->format('F'),
                ];
            }

            if(request()->ajax() && request()->has('step')){
                $new_next = Carbon::parse(request('date'))->addMonth(1)->format('Y-m-d');
                $new_prev = Carbon::parse(request('date'))->subMonth(1)->format('Y-m-d');
                return [
                    'view' =>  $this->stepIncrements(Carbon::parse(request('date'))->format('m'),Carbon::parse(request('date'))->format('Y')),
                    'new_next' => $new_next,
                    'new_prev' => $new_prev,
                    'month_name' => Carbon::parse(request('date'))->format('F Y'),
                ];
            }

            $loyaltys = Employee::query()
                    ->select('slug','employee_no','lastname','firstname','firstday_gov',DB::raw('YEAR(firstday_gov) as firstday_gov_year'),DB::raw('YEAR(firstday_gov) as firstday_gov_year'),DB::raw(Carbon::now()->format("Y").' - YEAR(firstday_gov) as years_in_gov'))
                    ->where(DB::raw('('.Carbon::now()->format("Y").' - YEAR(firstday_gov)) % 5'),'=',0)
                    ->where(DB::raw(Carbon::now()->format("Y").' - YEAR(firstday_gov)'),'>',9)
                    ->where('locations','!=', 'COS')
                    ->where('locations','!=','RETIREE')
                    ->where('is_active','!=','INACTIVE')
                    ->get();
            $loyaltysArr = [];
            foreach ($loyaltys as $loyalty) {
                $loyaltysArr[$loyalty->years_in_gov][$loyalty->slug] = $loyalty;
            }
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
            $male_employees = Employee::where('sex','MALE')->where('is_active','ACTIVE')->count();
            $female_employees = Employee::where('sex','FEMALE')->where('is_active','ACTIVE')->count();
            $all_employees = Employee::where('is_active','ACTIVE')->count();
            $all_applicants = Applicant::count();

            $male_jo_employees = JoEmployees::query()->where('sex','=','MALE')->count();
            $female_jo_employees = JoEmployees::query()->where('sex','=','FEMALE')->count();
            $all_jo_employees = JoEmployees::count();
            return view('dashboard.home.hru_index')->with([
                'male_employees' => $male_employees,
                'female_employees' => $female_employees,
                'all_employees' => $all_employees,
                'per_course' => $per_course,
                'per_date_received' => $per_date_received,
                'all_applicants' => $all_applicants,
                'all_leave_applications' => $all_leave_applications,
                'all_ps' => $all_ps,
                'male_jo_employees' => $male_jo_employees,
                'female_jo_employees' => $female_jo_employees,
                'all_jo_employees' => $all_jo_employees,
                'bday_celebrants_view' => $this->birthdayCelebrantsView(Carbon::now()->format('m')),
                'step_increments_view' => $this->stepIncrements(Carbon::now()->format('m'),Carbon::now()->format('Y')),
                'loyaltys' => $loyaltysArr
            ]);
        }

        if(Auth::user()->dash == 'records'){

            $sent_by_week = DocumentDisseminationLog::
                select('sent_at')
                ->get()
                ->groupBy(function($date) {
                    return Carbon::parse($date->sent_at)->format('W');
                })->count();

            $sent_all = DocumentDisseminationLog::
            select('sent_at')
                ->count();
            $avg_sent_by_week = round($sent_all/$sent_by_week,0);

            $emails_per_contact = DocumentDisseminationLog::with(['emailContact','employee'])
                ->select('email_contact_id','employee_no',DB::raw('count(slug) as count'))
                ->groupBy('email_contact_id','employee_no')
                ->get();



            $documents_per_week = Document::select('reference_no','date')
                ->orderBy('date','asc')
                ->get();

            $documents_per_month_arr = [];

            foreach ($documents_per_week as $doc){
                if(isset($documents_per_month_arr[date('Ym',strtotime($doc->date)).'01'])){
                    $documents_per_month_arr[date('Ym',strtotime($doc->date)).'01'] = $documents_per_month_arr[date('Ym',strtotime($doc->date)).'01'] + 1;
                }else{
                    $documents_per_month_arr[date('Ym',strtotime($doc->date)).'01'] = 1;
                }

            }
            ksort($documents_per_month_arr);


            return view('dashboard.home.records_index')->with([
                'all_documents' => Document::count(),
                'all_emails_sent' => DocumentDisseminationLog::where('status','sent')->count(),
                'all_contacts' => EmailContact::count(),
                'avg_sent_by_week' => $avg_sent_by_week,
                'emails_per_contact' => $emails_per_contact,
                'documents_per_month' => $documents_per_month_arr,
            ]);
        }

        if(Auth::user()->dash == ''){
            return redirect('/dashboard/dtr/my_dtr');
        }
    	return $this->home->view();
    }
}
