<?php


namespace App\Http\Controllers;


use App\Models\BiometricDevices;
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
}