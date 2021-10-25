<?php


namespace App\Swep\Helpers;


class Helper
{
    public static function online_badge($last_activity){
        if($last_activity->diffInSeconds() < 301){
            return '<span class="label bg-green col-md-12">ONLINE</span>';
        }else{
            if($last_activity->diffInMinutes() < 60){
                return '<span class="label bg-gray col-md-12">Active <br>'.$last_activity->diffInMinutes().' minutes ago</span>';
            }else{
                if($last_activity->diffInMinutes() >= 60){
                    if($last_activity->diffInHours() < 2){
                        return '<span class="label bg-gray col-md-12">Active an hour ago</span>';
                    }else{
                        if($last_activity->diffInHours() > 23){
                            if($last_activity->diffInDays() < 2){
                                return '<span class="label bg-gray col-md-12">Active a day ago</span>';
                            }else{
                                return '<span class="label bg-gray col-md-12">Active <br>'.$last_activity->diffInDays().' days ago</span>';
                            }
                        }
                        return '<span class="label bg-gray col-md-12">Active <br>'.$last_activity->diffInHours().' hours ago</span>';
                    }
                }
            }
        }
    }
}