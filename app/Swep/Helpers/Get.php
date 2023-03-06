<?php


namespace App\Swep\Helpers;


use App\Models\SMS\CropYears;
use App\Models\SMS\WeeklyReports;
use Illuminate\Support\Carbon;

class Get
{
    public static function closestSundayAhead($date = null){
        if($date == null){
            $date = Carbon::now()->format('Y-m-d');
        }else{
            $date = Carbon::parse($date)->format('Y-m-d');
        }

        if(Carbon::parse($date)->dayOfWeek == 0){
            return Carbon::parse($date)->format('Y-m-d');
        }else{
            if(Carbon::parse($date)->dayOfWeek == 6){
                return Carbon::parse($date)->nextWeekendDay()->format('Y-m-d');
            }else{
                return Carbon::parse($date)->nextWeekendDay()->addDays(1)->format('Y-m-d');
            }
        }
    }


    public static function currentCropYear(){
        $cy = CropYears::query()->where('is_current','=',1)->first();
        return $cy->name ?? null;
    }

    public static function reportNoByWeekEndingCropYear($we,$cy){
        $wr = WeeklyReports::query()
            ->select('week_ending','report_no')
            ->where('week_ending','=',$we)
            ->where('crop_year','=',$cy)
            ->groupBy('wee
            
            
            
            
            
            ')
    }
}