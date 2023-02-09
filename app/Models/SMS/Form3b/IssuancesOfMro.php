<?php


namespace App\Models\SMS\Form3b;


use App\Models\SMS\WeeklyReports;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class IssuancesOfMro extends Model
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
    protected $table = 'form3b_issuances_of_sro';

    public function weeklyReport(){
        return $this->belongsTo(WeeklyReports::class,'weekly_report_slug','slug');
    }
}