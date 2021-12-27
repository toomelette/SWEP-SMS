<?php


namespace App\Swep\Services;


use App\Models\CronLogs;
use App\Models\DailyTimeRecord;
use App\Models\DTR;
use App\Models\Employee;
use App\Models\JoEmployees;
use App\Models\SuSettings;
use App\Swep\BaseClasses\BaseService;
use App\Swep\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Rats\Zkteco\Lib\ZKTeco;

class DTRService extends BaseService
{
    public function extract($ip){
        try{
            $last_uid = 0;
            $attendances = $this->fetchAttendance($ip);
            $serial_no = $this->getSerialNo($ip);
            $last_dtr_raw = DTR::query()->where('device' ,'=',$serial_no)->orderBy('uid','desc')->first();
            if(!empty($last_dtr_raw)){
                $last_uid = $last_dtr_raw->uid;
            }

            $attendances_array = [];
            foreach ($attendances as $key => $attendance){
                if($key > $last_uid){
                    array_push($attendances_array,[
                        'uid' => $attendance['uid'],
                        'user' => $attendance['id'],
                        'state' => $attendance['state'],
                        'timestamp' => $attendance['timestamp'],
                        'type' => $attendance['type'],
                        'device' => $serial_no,
                    ]);
                }

            }
            if(count($attendances_array) > 0){
                $a = DTR::insert($attendances_array);
                if($a){
                    $string = 'Copied '.count($attendances_array).' data from device: '.$ip;
                    $cl = new CronLogs;
                    $cl->log = $string;
                    $cl->type = 1;
                    $cl->save();

                    //CLEAR ZK TECO ATTENDANCE
                    //$this->clearAttendance($ip);
                    return $string;
                }
                return $attendances_array;
            }else{
                $string = 'Copied '.count($attendances_array).' data from device: '.$ip.' | No new attendance';
                $cl = new CronLogs;
                $cl->log = $string;
                $cl->type = 1;
                $cl->save();


                return 'No new attendance found';
            }

        }catch (\Exception $e){
            $string = 'Error saving data from device: '.$ip.' | Device might be turned off.';
            $cl = new CronLogs;
            $cl->log = $string;
            $cl->type = 0;
            $cl->save();

            echo 'Device might be off: '.$e->getMessage();
        }
    }

    public  function reconstruct(){
        $dtrs_raw = DTR::query()->where('processed','=',null)
            ->orWhere('processed','=',0)->get();
        $values = $this->biometric_values();
        $no_of_processed = 0;

        foreach ($dtrs_raw as $dtr_raw) {
            $biometric_user_id = $dtr_raw->user;
            $p_employee = Employee::query()->select('firstname','lastname','biometric_user_id','employee_no',DB::raw('"permanent" as type'))->where('biometric_user_id','=',$biometric_user_id);
            $jo_employee = JoEmployees::query()->select('firstname','lastname','biometric_user_id','employee_no',DB::raw('"jo" as type'))->where('biometric_user_id','=',$biometric_user_id);
            $employees = $p_employee->union($jo_employee)->first();
            if(!empty($employees)){
                $dtr_check = DailyTimeRecord::query()
                    ->where('date','=',Carbon::parse($dtr_raw->timestamp)->format('Y-m-d'))
                    ->where('employee_no','=',$employees->employee_no)
                    ->first();
                $db_col = $values[$dtr_raw->type];
                if(empty($dtr_check)){
                    $dtr = new DailyTimeRecord;
                    $dtr->$db_col = Carbon::parse($dtr_raw->timestamp)->format('H:i');
                    $dtr->date = Carbon::parse($dtr_raw->timestamp)->format('Y-m-d');
                    $dtr->employee_no = $employees->employee_no;
                    $dtr->biometric_user_id = $biometric_user_id;
                    $dtr->biometric_uid = 0;
                    $dtr->calculated = 0;
                    if($dtr->save()){
                        $dtr_raw->processed = 1;
                        $dtr_raw->update();
                        $no_of_processed++;
                    }
                }else{
                    $dtr_check->$db_col = Carbon::parse($dtr_raw->timestamp)->format('H:i');
                    $dtr_check->biometric_user_id = $biometric_user_id;
                    $dtr_check->biometric_uid = 0;
                    $dtr_check->calculated = 0;
                    if($dtr_check->update()){
                        $dtr_raw->processed = 1;
                        $dtr_raw->update();
                        $no_of_processed++;
                    }
                }
            }
        }

        $cl = new CronLogs;
        $cl->log = 'Reconstructed '.$no_of_processed.' raw DTR data';
        $cl->type = 1;
        $cl->save();
    }

    public function compute(){
        $latest_time_in = SuSettings::query()->where('setting','=','permanent_latest_time_in')->first()->time_value;
        $earliest_time_out = SuSettings::query()->where('setting','=','permanent_earliest_time_out')->first()->time_value;
        $late = 0;
        $undertime = 0;

        $jo_latest_time_in = SuSettings::query()->where('setting','=','jo_latest_time_in')->first()->time_value;
        $jo_earliest_time_out = SuSettings::query()->where('setting','=','jo_earliest_time_out')->first()->time_value;

        $dtrs = DailyTimeRecord::query()->where('calculated','=',null)->orWhere('calculated' , '=' ,0)->get();
        $no_of_computed = 0;
        if(!empty($dtrs)){
            foreach ($dtrs as $dtr){
                $no_of_computed++;
                $p_employee = Employee::query()->select('lastname','firstname',DB::raw('"PERM" as type'))->where('employee_no', '=' ,$dtr->employee_no);
                $jo_employee = JoEmployees::query()->select('lastname','firstname',DB::raw('"JO" as type'))->where('employee_no', '=' ,$dtr->employee_no);
                $all_employees = $p_employee->union($jo_employee);
                $employee = $all_employees->first();
//              $employee->type = 'PERM';
                if($employee->type == 'JO'){
                    $latest_time_in = $jo_latest_time_in;
                    $earliest_time_out = $jo_earliest_time_out;
                }

                if($employee->type == 'PERM'){
                    if($dtr->am_in == null || $dtr->am_in == '' || $dtr->am_in > $latest_time_in){
                        $earliest_time_out = '18:00';
                    }else{
                        $earliest_time_out = Carbon::parse($dtr->am_in)->addHours(9)->format('H:i');
                    }
                }

                //AM IN
                if($dtr->am_in > $latest_time_in){
                    $diff = Carbon::parse($dtr->am_in)->diffInMinutes($latest_time_in);
                    $late = $late+$diff;
                }

                //PM IN
                if($dtr->pm_in > '13:00'){
                    $diff = Carbon::parse($dtr->pm_in)->diffInMinutes('13:00');
                    $late = $late + $diff;
                }

                //AM OUT
                if($dtr->am_out < '12:00'){
                    $diff = Carbon::parse($dtr->am_out)->diffInMinutes('12:00');
                    $undertime = $undertime + $diff;
                }

                //PM OUT
                if($dtr->pm_out < $earliest_time_out){
                    $diff = Carbon::parse($dtr->pm_out)->diffInMinutes($earliest_time_out);
                    $undertime = $undertime + $diff;
                }

                $dtr->calculated = 1;
                if(empty($dtr->am_in) || empty($dtr->am_out) || empty($dtr->pm_in) || empty($dtr->pm_out) || $dtr->am_in == '00:00:00' || $dtr->am_out == '00:00:00' || $dtr->pm_in == '00:00:00' || $dtr->pm_out == '00:00:00'){
                    $dtr->calculated = -1;
                }
                $dtr->late = $late;
                $dtr->undertime = $undertime;

                $dtr->save();
            }
            if($no_of_computed > 0){
                $cl = new CronLogs;
                $cl->log = 'Computed '.$no_of_computed.' DTR Data';
                $cl->type = 3;
                $cl->save();
                return 1;
            }
        }
        return 0;
    }


    public  function biometric_values($displayMode = false){
        if($displayMode == false){
            return [
                10 => 'am_in',
                20 => 'am_out',
                30 => 'pm_in',
                40 => 'pm_out',
                50 => 'ot_in',
                60 => 'ot_out',
            ];
        }else{
            return [
                10 => 'Morning IN',
                20 => 'Morning OUT',
                30 => 'Afternoon IN',
                40 => 'Afternoon OUT',
                50 => 'Overtime IN',
                60 => 'Overtime OUT',
            ];
        }
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
        return  preg_replace('/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F]/', '', Helper::getStingAfterChar($zk->serialNumber(),'='));
    }

}