<?php


namespace App\Models\SMS\Form5a;


use App\Models\SMS\WeeklyReports;
use Illuminate\Database\Eloquent\Model;

class IssuancesOfSro extends Model
{
    protected $table = 'form5a_issuances_of_sro';


    public function weeklyReport(){
        return $this->belongsTo(WeeklyReports::class,'weekly_report_slug','slug');
    }
}