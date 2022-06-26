<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsLike extends Model
{
    protected $fillable=['news_id','user_id'];
    public function likes(){
        return $this->hasMany(NewsLike::class,'news_id');

    }
}
