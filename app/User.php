<?php
namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Hash;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
*/
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use HasApiTokens;

    protected $fillable = ['first_name','last_name','email', 'phone', 'password', 'remember_token'];
    
    
    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    
    
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
    public function profileYouViewed()
    {
        return $this->belongsToMany('App\User', 'recently_views', 'viewer_id', 'viewed_id');

    }
    public function profileViewedYou()
    {
        return $this->belongsToMany('App\User', 'recently_views', 'viewed_id', 'viewer_id');

    }
    public function userProfile()
    {
        return $this->hasOne('App\Models\Profile'::class, 'user_id','id');
    }
    
    public function userPlan()
    {
        return $this->belongsToMany('App\Models\Plan'::class,'user_subscriptions','user_id', 'plan_id');
    }
    public function picture()
    {
        return $this->belongsTo('App\Models\ProfilePicture'::class,'id','user_id');
    }
}
