<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable=['name'];


    public function groupUser()
    {
        return $this->belongsToMany(User::class,'group_user','group_id','user_id');
    }
}
