<?php


namespace App\Models\Temp;


use Illuminate\Database\Eloquent\Model;

class DocsQC extends Model
{
    protected $connection = 'mysql_records_qc';
    protected $table = 'rec_documents_old_structure';

    public function logs(){
        return $this->hasMany(Logs::class,'document_id','old_document_id');
    }
}