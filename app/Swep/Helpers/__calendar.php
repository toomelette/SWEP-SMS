<?php


namespace App\Swep\Helpers;


use App\Models\SMS\Calendar;
use Carbon\Carbon;

class __calendar
{
    public static function currentWeek($weekEnding = null){
        if($weekEnding == null){
            $weekEnding = Carbon::now()->format('Y-m-d');
        }else{
            $weekEnding = Carbon::parse($weekEnding)->format('Y-m-d');
        }
        $c = Calendar::query()->where('week_ending','<=',$weekEnding)
            ->orderBy('week_ending','desc')
            ->first();
        return $c ?? null;
    }

    public static function previousWeek(){
        $c = Calendar::query()->where('week_ending','<=',Carbon::now()->subDays(7)->format('Y-m-d'))
            ->orderBy('week_ending','desc')
            ->first();
        return $c ?? null;
    }


}