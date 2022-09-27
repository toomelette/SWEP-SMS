<?php


namespace App\Models\SMS;


use Auth;
use Illuminate\Database\Eloquent\Model;

class WeeklyReports extends Model
{
    public static function boot()
    {
        parent::boot();
        static::updating(function($a){
            $a->user_updated = Auth::user()->user_id;
            $a->ip_updated = request()->ip();
            $a->updated_at = \Carbon::now();
        });

        static::creating(function ($a){
            $a->user_created = Auth::user()->user_id;
            $a->ip_created = request()->ip();
            $a->created_at = \Carbon::now();
        });
    }
    protected $table = 'weekly_reports';

    public function cropYear(){
        return $this->belongsTo(CropYears::class,'crop_year','slug');
    }

    public function details(){
        return $this->hasMany(WeeklyReportDetails::class, 'weekly_report_slug','slug');
    }

    public function seriesNos(){
        return $this->hasMany(WeeklyReportSeriesPcs::class, 'weekly_report_slug','slug');
    }
}