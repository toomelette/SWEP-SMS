<?php


namespace App\Models\Temp;


use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $connection = 'mysql_records_qc';
    protected $table = 'rec_document_dissemination_logs';

    public $timestamps = false;
    public $fillable = ['document_id'];
}