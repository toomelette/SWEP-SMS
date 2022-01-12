<?php


namespace App\Http\Controllers;


use App\Models\BiometricDevices;
use App\Models\Employee;
use App\Models\JoEmployees;
use App\Models\UserSubmenu;
use App\Swep\Services\DTRService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Rats\Zkteco\Lib\ZKTeco;

class BiometricDevicesController extends Controller
{

    public function index(){
        $colors = [
            1 => 'bg-green',
            2 => 'bg-aqua',
            3 => 'bg-purple',
        ];

        $devices = BiometricDevices::query()->get();
        return view('dashboard.biometric_devices.index')->with([
            'devices' => $devices,
            'colors' => $colors,
        ]);
    }

    public function restart(Request $request){
        $device = BiometricDevices::query()->find($request->id);

        if(empty($device)){
            abort(503,'Device not found');
        }

        if($device->status != 1){
            abort(503,'Device status is set to off. Change it to active first.');
        }

        $ip = $device->ip_address;
        try{
            $zk = new ZKTeco($ip);
            $zk->connect();
            $zk->restart();
        }catch (\Exception $e){
           // return $e;
            abort(503,'Error communicating to device. Device might be off.');
        }

    }

    public function extract(Request $request, DTRService $DTRService){
        $user_id = Auth::user()->user_id;
        $check_sm = UserSubmenu::query()->where('user_id','=',$user_id)->where('submenu_id','=','rfOgNb0Y')->first();
        if(empty($check_sm)){
            abort(503,'You are not allowed to make this action');
        }

        $device = BiometricDevices::query()->find($request->id);
        $ip_address = $device->ip_address;

        $serve = $DTRService->extract($ip_address);
        return $serve;
    }
    public function attendances(Request $request){
        if (!$request->has('id')){
            abort(503,'Missing parameters');
        }

        $device = BiometricDevices::query()->find($request->id);
        if (empty($device)){
            abort(503,"Device not found");
        }
        if($device->status != 1){
            abort(503,'Device is not available.');
        }
        $ip_address = $device->ip_address;

        $employees_arr = [];

        $perm_e = Employee::query()->select('firstname','middlename','lastname','employee_no','biometric_user_id')->where('biometric_user_id', '!=' ,0);
        $jo_e = JoEmployees::query()->select('firstname','middlename','lastname','employee_no','biometric_user_id')->where('biometric_user_id' ,'!=' ,0);

        $union = $jo_e->union($perm_e)->get();

        foreach ($union as $employee){
            $employees_arr[$employee->biometric_user_id] = $employee;
        }
        try{
            $zk = new ZKTeco($ip_address);
            $zk->connect();
            $attendances = $zk->getAttendance();
//            return $attendances;
            return view('dashboard.biometric_devices.logs')->with([
                'attendances' => $attendances,
                'device' => $device,
                'employees_arr' => $employees_arr,
            ]);
        }catch (\Exception $e){
            return $e->getMessage();
        }


        return $request;
    }
}