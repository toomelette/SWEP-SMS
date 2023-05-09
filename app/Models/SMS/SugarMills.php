<?php


namespace App\Models\SMS;


use Illuminate\Database\Eloquent\Model;

class SugarMills extends Model
{
    protected $table = 'sugar_mills';

    public function signatories(){
        return $this->hasMany(Signatories::class,'mill_code','slug');
    }

    public function weeklyReportsSubmitted(){
        return $this->hasMany(WeeklyReports::class,'mill_code','slug')
            ->where('status','=',1)
            ->orderBy('week_ending','asc');
    }

    public function requestsForCancellation(){
        return $this->hasManyThrough(
            RequestsForCancellation::class,WeeklyReports::class,'mill_code','weekly_report_slug','slug','slug'
        );
    }
    public function requestsForCancellationNoAction(){
        return $this->hasManyThrough(
            RequestsForCancellation::class,WeeklyReports::class,'mill_code','weekly_report_slug','slug','slug'
        )->where('action','=',null);
    }
}