<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class NewsComment extends Model
{
    protected $fillable=['news_id','user_id','comment'];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
