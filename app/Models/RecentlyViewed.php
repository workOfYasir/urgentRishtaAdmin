<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecentlyViewed extends Model
{
    protected $filable = ['viewer_id', 'viewed_id'];

    protected $table = 'recently_views';

    public function viewedYourProfile()
    {
        return $this->hasMany('App\User'::class,'id','viewer_id')->with('userProfile');
    }

    public function profileYouViewed()
    {
      //  return $this->belongsToMany('App\User', 'recently_views', 'id', 'viewed_id');

        return $this->hasMany('App\User'::class,'id','viewed_id')->with('userProfile');
    }
}
