<?php


namespace App\Http\Controllers;


use Spatie\Activitylog\Models\Activity;

class ActivityLogsController extends Controller
{
    public function fetch_properties(){
        if(request()->has('id')){
            $id = request()->id;
            //return $id;
            $activity = Activity::with(['causer','subject'])->where('id',$id)->first();
//            return $a_l->properties;

            return view('dashboard.activity_logs.fetch_properties')->with(['activity' => $activity]);
        }
    }
}