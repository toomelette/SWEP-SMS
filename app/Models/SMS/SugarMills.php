<?php


namespace App\Models\SMS;


use Illuminate\Database\Eloquent\Model;

class SugarMills extends Model
{
    protected $table = 'sugar_mills';

    public function signatories(){
        return $this->hasMany(Signatories::class,'mill_code','slug');
    }
}