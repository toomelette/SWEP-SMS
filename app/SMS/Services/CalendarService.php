<?php


namespace App\SMS\Services;


use App\Models\SMS\Calendar;
use Illuminate\Support\Carbon;

class CalendarService
{
    public function byMonth($year){
        $weeks = Calendar::query()->where('crop_year' ,'=',$year)->orderBy('report_no','asc')->get();
        $calendar = [];
        if(!empty($weeks)){
            foreach ($weeks as $week){
                $calendar[Carbon::parse($week->week_ending)->format('Y-m-01')][Carbon::parse($week->week_ending)->format('Y-m-d')] = null;
            }
        }
        return $calendar;
    }

    public function byYear(){
        $weeks = Calendar::query()->orderBy('crop_year','asc')->orderBy('report_no','asc')->get();
        $calendar = [];

        if(!empty($weeks)){
            foreach ($weeks as $week){
                $calendar[$week->crop_year][Carbon::parse($week->week_ending)->format('Y-m-01')][Carbon::parse($week->week_ending)->format('Y-m-d')] = $week->report_no;
            }
        }
        return $calendar;
    }
}