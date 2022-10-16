<?php
namespace App;

use App\Models\UserFriend;
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
    protected $primaryKey = "id";
//    protected $appends = ['sender_name'];
//'receiver_name',
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
        return $this->hasOne('App\Models\Profile', 'user_id','id')->with('religion')->with('cast')->with('country')->with('city')->with('state')->with('user');
    }
    
    public function userPlan()
    {
        return $this->belongsToMany('App\Models\Plan','user_subscriptions','user_id', 'plan_id');
    }

    public function picture()
    {
        return $this->hasMany('App\Models\ProfilePicture','user_id','id');
    }

    public function friendRequest()
    {
        return $this->belongsTo(UserFriend::class,'id','receiver_id')->with('receiver')->with('sender');
    }

}
