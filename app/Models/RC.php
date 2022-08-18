<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class RC extends Model
{
    protected $connection = 'mysql_ppu';
    protected $table = 'rc_description';
}