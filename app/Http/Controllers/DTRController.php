<?php


namespace App\Http\Controllers;


use App\Models\BiometricDevices;
use App\Models\CronLogs;
use App\Models\DailyTimeRecord;
use App\Models\DTR;
use App\Models\Employee;
use App\Models\Holiday;
use App\Models\JoEmployees;
use App\Swep\Helpers\__sanitize;
use App\Swep\Helpers\Helper;
use App\Swep\Services\DTRService;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rats\Zkteco\Lib\ZKTeco;

class DTRController extends  Controller
{
    protected $dtr_service;
    public function __construct(DTRService $dtr_service)
    {
        $this->dtr_service = $dtr_service;
    }

    public function extract(){
        if(request()->ajax()){
            if(request()->has('extract')){
                $biometric_device = BiometricDevices::query()->find(request('device'));

                $date = request('date_range');
                $ip = $this->getDeviceIpById(request('device'));

                $attendance = $this->fetchAttendance($ip);
                $date_range = __sanitize::date_range(request('date_range'));
                $new_attendance  = [];
                foreach ($attendance as $data){
                    if(Carbon::parse($data['timestamp'])->format('Ym') == Carbon::parse(request('date_range'))->format('Ym')){
                        $new_attendance[$data['uid']] = $data;
                    }
                }
                return view('dashboard.dtr.temp_table')->with([
                    'attendance' => $new_attendance,
                    'date_range' => $date_range,
                    'device' => $biometric_device->id,
                ]);
            }
        }
        return view('dashboard.dtr.extract');
    }

    private function pingAddress($ip) {
        $pingresult = exec("/bin/ping -n 3 $ip", $outcome, $status);
        if (0 == $status) {
            $status = "alive";
        } else {
            $status = "dead";
        }
        echo "The IP address, $ip, is  ".$status;
    }



    public function extract2(){

        $ip = '10.36.1.22';
        return $this->dtr_service->extract($ip);

    }



    public function reconstruct(){
        return $this->dtr_service->reconstruct();
    }

    public function store(Request $request){

        //return $this->calculateLateUndertime('permanent');
        $ip = $this->getDeviceIpById(request('device'));
        $attendance_from_device = $this->fetchAttendance($ip);
        $attendance_to_db = [];
        $employees = Employee::query()->get();
        $employees_array = [];
        if(!empty($employees)){
            foreach ($employees as $employee){
                $appointment_status = '';
                if($employee->appointment_status == 'P' || $employee->appointment_status == 'PERM'){
                    $appointment_status = 'Permanent';
                }
                $employees_array[$employee->biometric_user_id] = [
                    'employee_no' => $employee->employee_no,
                    'appointment_status' => $appointment_status,
                ];
            }
        }

        foreach ($request->uid_list as $uid){

            $dtr_check = DailyTimeRecord::query()
                ->where('date','=' ,Carbon::parse($attendance_from_device[$uid]['timestamp'])->format('Y-m-d'))
                ->where('biometric_user_id' ,'=',$attendance_from_device[$uid]['id'])
                ->first();

            $values = [
                0 => 'am_in',
                1 => 'pm_out',
                2 => 'pm_in',
                3 => 'pm_in',
                4 => 'ot_in',
                5 => 'ot_out',
            ];

            $db_col = $values[$attendance_from_device[$uid]['type']];




            if(empty($dtr_check)){
                $dtr = new DailyTimeRecord;
                $dtr->employee_no = 1;
                $dtr->biometric_user_id = $attendance_from_device[$uid]['id'];
                $dtr->biometric_uid = 3;
                $dtr->$db_col = $attendance_from_device[$uid]['timestamp'];
                $dtr->date = Carbon::now()->format('Y-m-d');
                $dtr->calculated = 0;
                $dtr->save();
            }else{
                $dtr_check->employee_no = 11;
                $dtr_check->biometric_user_id = $attendance_from_device[$uid]['id'];
                $dtr_check->biometric_uid = 13;
                $dtr_check->$db_col = $attendance_from_device[$uid]['timestamp'];
                $dtr_check->date = Carbon::now()->format('Y-m-d');
                $dtr_check->calculated = 0;
                $dtr_check->update();
            }
        }
        return 500;

        foreach ($request->uid_list as $uid){
            $dtr_check = DTR::query()->where('uid','=',$uid)->first();
            if(empty($dtr_check)){
                $dtr = new DTR;
                $dtr->uid = $uid;
                $dtr->user = $attendance_from_device[$uid]['id'];
                $dtr->state = $attendance_from_device[$uid]['state'];
                $dtr->type = $attendance_from_device[$uid]['type'];
                $dtr->timestamp = $attendance_from_device[$uid]['timestamp'];
                $dtr->device = $request->device;
                $dtr->save();
            }
        }
        return 1;
        return $attendance_to_db;
    }


    public function myDtr(){
        $employee = $this->getCurrentUserEmployeeObj();
        $dtr_by_year = [];
        if(!empty($employee->dtr_records)){
            $dtr_records = $employee->dtr_records()->orderBy('date','desc')->get();
            if($dtr_records->count() > 0){
                foreach ($dtr_records as $dtr_record) {
                    $dtr_by_year[Carbon::parse($dtr_record->date)->format('Y')][Carbon::parse($dtr_record->date)->format('Y-m')] = null;
                }
            }
        }
        return view('dashboard.dtr.my_dtr')->with([
            'employee' => $employee,
            'dtr_by_year' => $dtr_by_year,
        ]);
    }

    public function fetchByUserAndMonth(Request $request){
        if(request()->has('bm_u_id') || request()->has('month')){
            $dtrs = DailyTimeRecord::query()->where('biometric_user_id','=',$request->bm_u_id)->
                where('date','like',$request->month.'%')->orderBy('date','asc')->get();
            $dtr_array = [];
            if($dtrs->count() > 0){
                foreach ($dtrs as $dtr) {
                    $dtr_array[$dtr->date] = $dtr;
                }
            }
            $holidays = $this->holidaysArray($request->month);
            //return $holidays;
            return view('dashboard.dtr.my_dtr_preview')->with([
                'month' => $request->month,
                'dtr_array' =>  $dtr_array,
                'holidays' => $holidays,
            ]);
        }else{
            abort(404);
        }
    }

    public function download(Request $request){
        if(!request()->has('month')){
            abort(404);
        }

        $employee = $this->getCurrentUserEmployeeObj();
        $dtrs = DailyTimeRecord::query()->where('biometric_user_id','=',$employee->biometric_user_id)->
        where('date','like',$request->month.'%')->orderBy('date','asc')->get();

        $dtr_array = [];
        if($dtrs->count() > 0){
            foreach ($dtrs as $dtr) {
                $dtr_array[$dtr->date] = $dtr;
            }
        }

        $holidays = $this->holidaysArray($request->month);


        $data = [
            'month' => $request->month,
            'dtr_array' =>  $dtr_array,
            'holidays' => $holidays,
            'employee' => $employee,
        ];

        $pdf = PDF::loadView('dashboard.dtr.downloadable_dtr',$data)->setPaper('letter');
        //return view('dashboard.dtr.downloadable_dtr',$data);
        return $pdf->download('DTR-'.$employee->lastname.'-'.Carbon::parse($request->month)->format("Y,F").'.pdf');

    }

    public function holidaysArray($month = null){
        $holidays_array = [];
        if($month != null){
            $month = Carbon::parse($month)->format('Y-m');
            $holidays = Holiday::query()->where('date','like',$month.'%')->get();
        }else{
            $holidays = Holiday::query()->get();
        }

        if($holidays->count() > 0){
            foreach ($holidays as $holiday){
                $holidays_array[$holiday->date] = [
                    'name' => $holiday->name,
                    'date' => $holiday->date,
                    'type' => $holiday->type,
                ];
            }
        }
        return $holidays_array;
    }

    private function getCurrentUserEmployeeObj(){
        $user_employee_no = Auth::user()->employee_no;
        $perm_employee = Employee::query()->where('employee_no','=',$user_employee_no)->first();
        $employee = null;
        if(!empty($perm_employee)){
            $employee = $perm_employee;
        }else{
            $jo_employee = JoEmployees::query()->where('employee_no','=',$user_employee_no)->first();
            if(!empty($jo_employee)){
                $employee = $jo_employee;
            }
        }
        return $employee;
    }
    private function fetchAttendance($ip){

        $attendance = [];
        $zk = new ZKTeco($ip);
        $zk->connect();
        $zk = $zk->getAttendance();
        foreach ($zk as $data){
            $attendance[$data['uid']] = $data;
        }
        return $attendance;
    }


    private function clearAttendance($ip){

        $zk = new ZKTeco($ip);
        $zk->connect();
        return $zk->clearAttendance();
    }

    private function getSerialNo($ip){
        $zk = new ZKTeco($ip);
        $zk->connect();
        return $zk->serialNumber();
    }

    private function getDeviceIpById($id){
        $biometric_device = BiometricDevices::query()->find($id);
        return $biometric_device->ip_address;
    }

    private  function calculateLateUndertime($appointment_status){

        //PERMANENT EMPLOYEES
        if($appointment_status == 'permanent'){
            $dtrs = DailyTimeRecord::query()->where('calculated' ,'=',0)->get();
            if(!empty($dtrs)){
                foreach ($dtrs as $dtr){
                    $late = 0;
                    $undertime = 0;
                    //CHECK IF AM IN IS LATE
                    if(Carbon::parse($dtr->am_in)->format('His') > '090000'){
                        $late = $late + Carbon::parse($dtr->am_in)->diffInMinutes('09:00:00');
                    }

                    //CHECK IF PM IN IS LATE
                    if(Carbon::parse($dtr->pm_in)->format('His') > '130000'){
                        $late = $late + Carbon::parse($dtr->pm_in)->diffInMinutes('13:00:00');
                    }

                    //CHECK IF AM OUT IS UNDERTIME
                    if(Carbon::parse($dtr->am_out)->format('his') < '120000'){
                        $undertime = $undertime + Carbon::parse($dtr->am_out)->diffInMinutes('12:00:00');
                    }

                    //CHECK IF PM OUT IS UNDERTIME
                    $should_pm_out = '180000';

                    //ADD 9 Hours From AM IN to get AM OUT
                    if($dtr->am_in != null){
                        $should_pm_out = Carbon::parse($dtr->am_in)->addHours(9)->format('His');
                    }

                    //IF AM IN IS EARLIER THAN 7AM
                    if(Carbon::parse($dtr->am_in)->format('His') < '070000'){
                        $should_pm_out = '160000';
                    }

                    //CHECK IF UNDERTIME
                    if(Carbon::parse($dtr->pm_out)->format('His') < Carbon::parse($should_pm_out)->format('His')){
                        $undertime = $undertime + Carbon::parse($dtr->pm_out)->diffInMinutes(date('His',strtotime($should_pm_out)));
                    }

                    $dtr->undertime = $undertime;
                    $dtr->late = $late;
                    $dtr->calculated = 0;
                    $dtr->update();
                }
            }
        }
    }
}