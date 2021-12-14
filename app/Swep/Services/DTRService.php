<?php


namespace App\Swep\Services;


use App\Models\CronLogs;
use App\Models\DailyTimeRecord;
use App\Models\DTR;
use App\Models\Employee;
use App\Models\JoEmployees;
use App\Swep\BaseClasses\BaseService;
use App\Swep\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Rats\Zkteco\Lib\ZKTeco;

class DTRService extends BaseService
{
    public function extract($ip){
        try{
            $attendances = $this->fetchAttendance($ip);
            $serial_no = Helper::getStingAfterChar($this->getSerialNo($ip),'=');

            $attendances_array = [];
            foreach ($attendances as $attendance){
                array_push($attendances_array,[
                    'uid' => $attendance['uid'],
                    'user' => $attendance['id'],
                    'state' => $attendance['state'],
                    'timestamp' => $attendance['timestamp'],
                    'type' => $attendance['type'],
                    'device' => $serial_no,
                ]);
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
                    $this->clearAttendance($ip);
                    return 1;
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
            $string = 'Error saving data from device: '.$ip;
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
                    $dtr->$db_col = $dtr_raw->timestamp;
                    $dtr->date = Carbon::parse($dtr_raw->timestamp)->format('Y-m-d');
                    $dtr->employee_no = $employees->employee_no;
                    $dtr->biometric_user_id = $biometric_user_id;
                    $dtr->biometric_uid = 0;
                    if($dtr->save()){
                        $dtr_raw->processed = 1;
                        $dtr_raw->update();
                        $no_of_processed++;
                    }
                }else{
                    $dtr_check->$db_col = $dtr_raw->timestamp;
                    $dtr_check->biometric_user_id = $biometric_user_id;
                    $dtr_check->biometric_uid = 0;
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


    private  function biometric_values(){
        return [
            10 => 'am_in',
            20 => 'am_out',
            30 => 'pm_in',
            40 => 'pm_out',
            50 => 'ot_in',
            60 => 'ot_out',
        ];
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

}