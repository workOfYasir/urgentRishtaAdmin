<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecentlyViewed extends Model
{
    protected $fillable = ['viewer_id', 'viewed_id'];

    protected $table = 'recently_views';

    public $timestamps = false;

    public function viewedYourProfile()
    {
        return $this->hasOne('App\User'::class,'id','viewer_id')->with('userProfile');
    }

    public function profileYouViewed()
    {
        return $this->hasMany('App\User'::class,'id','viewed_id')->with('userProfile');
    }
}
