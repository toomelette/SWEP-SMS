<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BiometricDevices extends Model
{
    protected $table = 'su_biometric_devices';

    public function attendances(){
        return $this->hasMany('App\Models\DTR','device','serial_no');
    }
}