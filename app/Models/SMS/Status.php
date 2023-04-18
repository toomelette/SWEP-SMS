<?php


namespace App\Models\SMS;


use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'report_status';

    public function weeklyReport(){
        return $this->belongsTo(WeeklyReports::class,'weekly_report_slug','slug');
    }
}