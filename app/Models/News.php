<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'su_news';


    public function attachments(){
        return $this->hasMany(NewsAttachments::class,'news','slug');
    }
}