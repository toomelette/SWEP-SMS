<?php


namespace App\Models\PPU;


use Illuminate\Database\Eloquent\Model;

class PPURCDesc extends Model
{
    protected $connection = 'mysql_ppu';
    protected $table = 'ppu_rc_description';

}