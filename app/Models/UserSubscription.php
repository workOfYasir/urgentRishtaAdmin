<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    public $timestamps = false;
    protected $fillable=['plan_id','user_id'];
}
