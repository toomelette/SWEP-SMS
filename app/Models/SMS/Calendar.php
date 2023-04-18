<?php


namespace App\Models\SMS;


use App\Models\SMS\Form1\Form1Details;
use App\Models\SMS\Form5\Deliveries;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendar';

    public function weeklyReports(){
        return $this->hasMany(WeeklyReports::class,'calendar_slug','slug')->where('status','=',1);
    }

    public function weeklyReportsForm1(){
        return $this->hasManyThrough(Form1Details::class,WeeklyReports::class,'calendar_slug','weekly_report_slug','slug','slug')
            ->where('status','=',1);

    }

    public function weeklyReportsForm5(){
        return $this->hasManyThrough(Deliveries::class,WeeklyReports::class,'calendar_slug','weekly_report_slug','slug','slug')
            ->where('status','=',1);
    }
}