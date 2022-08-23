<?php


namespace App\Models\Bridge;


use Illuminate\Database\Eloquent\Model;

class B_Employees extends Model
{
    protected $connection = 'swep_bridge';
    protected $table = 'hr_employees';
    protected $guarded = ['id','slug'];
}