<?php


namespace App\SMS\Services;


use App\Models\SMS\WeeklyReports;

class WeeklyReportService
{
    public function findWeeklyReportBySlug($slug){
        $wr = WeeklyReports::query()->where('slug','=',$slug)->first();
        if(empty($wr)){
            abort(503,'Weekly Report not found.');
        }
        return $wr;
    }

    public function isNotSubmitted($slug){
        $wr = $this->findWeeklyReportBySlug($slug);
        if($wr->status == 1){
            abort(503,'This weekly report has already been submitted. You cannot perform any actions other than viewing and printing.');
        }
        return true;
    }
}