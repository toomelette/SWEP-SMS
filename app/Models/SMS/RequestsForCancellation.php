<?php


namespace App\Models\SMS;


use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\Model;

class RequestsForCancellation extends Model
{

    protected $table = 'requests_for_cancellation';
    public $timestamps = false;

    public function weeklyReport(){
        return $this->belongsTo(WeeklyReports::class,'weekly_report_slug','slug');
    }

    public function user(){
        return $this->hasOne(User::class,'user_id','cancelled_by');
    }
}