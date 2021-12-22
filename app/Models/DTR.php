<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DTR extends Model
{
    protected $table = 'hr_dtr';
    public $timestamps = true;

    public function deviceDetails(){
        return $this->belongsTo('App\Models\BiometricDevices','device','serial_no');
    }

}