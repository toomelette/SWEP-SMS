<?php


namespace App\Models\SMS;


use Illuminate\Database\Eloquent\Model;

class RequestsForCancellation extends Model
{
    protected $table = 'requests_for_cancellation';
    public $timestamps = false;

    public function weeklyReport(){
        return $this->belongsTo(WeeklyReports::class,'weekly_report_slug','slug');
    }
}