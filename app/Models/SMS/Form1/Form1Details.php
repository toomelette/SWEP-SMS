<?php


namespace App\Models\SMS\Form1;


use App\Models\SMS\WeeklyReports;
use Illuminate\Database\Eloquent\Model;

class Form1Details extends Model
{
    protected $table = 'form1_details';
    public $timestamps = false;

    public function weeklyReport(){
        return $this->belongsTo(WeeklyReports::class,'weekly_report_slug','slug');
    }
}