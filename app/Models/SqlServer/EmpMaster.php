<?php


namespace App\Models\SqlServer;


use Illuminate\Database\Eloquent\Model;

class EmpMaster extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'dbo.EmpMaster';


}