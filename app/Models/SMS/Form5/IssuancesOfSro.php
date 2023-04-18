<?php


namespace App\Models\SMS\Form5;


use App\Models\SMS\WeeklyReports;
use Auth;
use Illuminate\Database\Eloquent\Model;

class IssuancesOfSro extends Model
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
    protected $table = 'form5_issuances_of_sro';

    public function weeklyReport(){
        return $this->belongsTo(WeeklyReports::class,'weekly_report_slug','slug');
    }

    public function deliveries(){
        return $this->hasMany(Deliveries::class,'sro_no','sro_no')->whereHas('weeklyReport',function ($q){
            $q->where('status','=',1);
        });
    }
}