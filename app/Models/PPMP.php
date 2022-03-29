<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PPMP extends Model
{

    public static function boot()
    {
        parent::boot();
        static::creating(function ($a){
            $a->user_created = Auth::user()->user_id;
//            $a->ip_created = request()->ip();
        });

        static::updating(function ($a){
            $a->user_updated = Auth::user()->user_id;
//            $a->ip_updated = request()->ip();
        });
    }


    protected $table = 'ppu_ppmp';

    public function pap(){
        return $this->belongsTo(RecommendedBudget::class, 'pap_code','pap_code');
    }
}