<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserFriend extends Model
{
    protected $table = 'user_friends';
    protected $appends = ['sender_name','receiver_name'];
    protected $fillable = ['sender_id', 'receiver_id', 'status'];
    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id','id');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id','id');
    }
    public function getSenderNameAttribute()
    {
        return $this->sender->first_name.' '.$this->sender->last_name;
    }
    public function getReceiverNameAttribute()
    {
        return $this->receiver->first_name.' '.$this->receiver->last_name;
    }

}
