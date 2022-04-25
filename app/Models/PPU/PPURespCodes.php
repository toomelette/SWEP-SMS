<?php


namespace App\Models\PPU;


use Illuminate\Database\Eloquent\Model;

class PPURespCodes extends Model
{
    protected $connection = 'mysql_ppu';
    protected $table = 'ppu_resp_codes';

    public function description(){
        return $this->hasOne(PPURCDesc::class,'rc','rc');
    }
}