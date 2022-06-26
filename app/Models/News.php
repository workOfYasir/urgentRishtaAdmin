<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable=['model_type','model_id'];
    public function newsable()
    {
        return $this->morphTo('posts','free_style_workouts','model_type','model_id');
    }
    public function likes()
    {
        return $this->hasMany(NewsLike::class,'news_id');
    }
}
