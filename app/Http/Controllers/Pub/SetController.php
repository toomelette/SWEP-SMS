<?php


namespace App\Http\Controllers\Pub;


use App\Http\Controllers\Controller;

class SetController extends Controller
{
    public function index(){
        if(request()->ajax()){
            if(request()->has('set')){
                $zk = new ZKTeco('10.36.1.'.request()->get('dev'));
                $zk->connect();
                $zk->setTime(request()->get('date').' '.request()->get('time'));
                return 1;
            }
            if (request()->has('reset')){
                $zk = new ZKTeco('10.36.1.'.request()->get('dev'));
                $zk->connect();
                $zk->setTime(\Carbon\Carbon::now()->format('Y-m-d H:i:s'));
                return 1;
            }
            if(request()->has('verify')){
                if(request()->get('password') === 'superadmin'){
                    request()->session()->put('verify',['expires_on'=>\Carbon\Carbon::now()->addMinutes(1)->format('Y-m-d H:i:s'),'type'=>'su']);
                    return 1;
                }
                if(request()->get('password') ==='misvis'){
                    request()->session()->put('verify',['expires_on'=>\Carbon\Carbon::now()->addMinutes(1)->format('Y-m-d H:i:s'),'type'=>'u']);
                    return 1;
                }
            }
            if (request()->has('insert')){
                $request = request();
                $dtr = \App\Models\DTR::query()->insert([
                    'user' => $request->user,
                    'state' => 1,
                    'uid' => rand(10000,99999),
                    'timestamp' => \Illuminate\Support\Carbon::parse($request->date)->format('Y-m-d').' '.\Illuminate\Support\Carbon::parse($request->time)->format('H:i:s'),
                    'type' => $request->type,
                    'device' => $request->device
                ]);

                if($dtr){
                    return 1;
                }else{
                    abort(501);
                }
            }
        }

        if (request()->session()->exists('verify')) {
            if(request()->session()->get('verify')['expires_on'] < \Carbon\Carbon::now()->format('Y-m-d H:i:s')){
                request()->session()->forget('verify');

                return view('dashboard.set.verify');
            }else{
                request()->session()->get('verify')['type'];
                if(request()->session()->get('verify')['type'] == 'su'){
                    if(request()->has('insert')){
                        return view('dashboard.set.insert');
                    }
                    return view('dashboard.set.index');

                }elseif(request()->session()->get('verify')['type'] == 'u'){

                    return view('dashboard.set.lower');
                }
            }
        }

//        return view('dashboard.set.insert');
        return view('dashboard.set.verify');
    }
}