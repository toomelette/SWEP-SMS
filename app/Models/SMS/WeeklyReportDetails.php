<?php


namespace App\Models\SMS;


use Illuminate\Database\Eloquent\Model;

class WeeklyReportDetails extends Model
{
    protected $table = 'weekly_reports_details';

    public function weeklyReport(){
        return $this->belongsTo(WeeklyReports::class,'weekly_report_slug','slug');
    }
}