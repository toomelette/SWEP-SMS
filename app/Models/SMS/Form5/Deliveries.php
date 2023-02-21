<?php


namespace App\Models\SMS\Form5;


use App\Models\SMS\WeeklyReports;
use Illuminate\Database\Eloquent\Model;

class Deliveries extends Model
{
    protected $table = 'form5_deliveries';

    public function weeklyReport(){
        return $this->belongsTo(WeeklyReports::class,'weekly_report_slug','slug');
    }

}