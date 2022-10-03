<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilePicture extends Model
{
    protected $table = 'profile_pictures';
    protected $fillable = ['user_id', 'image_name', 'image_path', 'property'];
    public function picture()
    {
        return $this->hasMany(ProfilePicture::class,'id','user_id');
    }
}
