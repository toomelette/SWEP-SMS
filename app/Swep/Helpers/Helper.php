<?php


namespace App\Swep\Helpers;
use Carbon;

class Helper
{
    public static function online_badge($lastActivity,$fullwidth = true){

        if($fullwidth == true){
            $cols = 'col-md-12';
            $br = '</br>';
        }else{
            $cols = '';
            $br = '';
        }
        if($lastActivity == null){
            return '<span class="label bg-gray '.$cols.'">OFFLINE</span>';
        }else{
            $last_activity = Carbon::parse($lastActivity);
            if($last_activity->diffInSeconds() < 301){
                return '<span class="label bg-green '.$cols.'">ONLINE</span>';
            }else{
                if($last_activity->diffInMinutes() < 60){
                    return '<span class="label bg-gray '.$cols.'">Active '.$br.$last_activity->diffInMinutes().' minutes ago</span>';
                }else{
                    if($last_activity->diffInMinutes() >= 60){
                        if($last_activity->diffInHours() < 2){
                            return '<span class="label bg-gray '.$cols.'">Active an hour ago</span>';
                        }else{
                            if($last_activity->diffInHours() > 23){
                                if($last_activity->diffInDays() < 2){
                                    return '<span class="label bg-gray '.$cols.'">Active a day ago</span>';
                                }else{
                                    return '<span class="label bg-gray '.$cols.'">Active '.$br.$last_activity->diffInDays().' days ago</span>';
                                }
                            }
                            return '<span class="label bg-gray '.$cols.'">Active '.$br.$last_activity->diffInHours().' hours ago</span>';
                        }
                    }
                }
            }
        }

    }

}