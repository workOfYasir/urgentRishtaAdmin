<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'user_profiles';

    protected $fillable= ['user_id', 'city_id', 'religion_id', 'sector_id', 'cast_id', 'country_id', 'gender','date_of_Birth', 'marital_status', 'height', 'On_behalf', 'star', 'disability', 'blood_group', 'current_residency_country', 'state_of_residency','town', 'number', 'whatsapp_number', 'hobbies', 'interest', 'qualification', 'edjuction_sector','working_with', 'company_name', 'language', 'no_of_brothers', 'no_of_sister', 'family_type', 'father_status', 'mother_status', 'brother_marital_status', 'family_address', 'living_with_family', 'annual_income', 'about','profile_viewed','view_contacts','pictures_settings'];

    protected $appends = ['age'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id')->with('picture')->with('profileViewedYou')->with('profileYouViewed')->with('userPlan')->with('friendRequest');
    }
    public function sector()
    {
        return $this->hasOne(Sector::class,'id','sector_id');
    }
    public function state()
    {
        return $this->hasOne(State::class,'id','state_id');
    }
    public function city()
    {
        return $this->hasOne(City::class,'id','city_id');
    }
    public function religion()
    {
        return $this->hasOne(Religion::class,'id','religion_id');
    }
    public function cast()
    {
        return $this->hasOne(Cast::class,'id', 'cast_id');
    }
    public function country()
    {
        return $this->hasOne(Country::class,'id','country_id');
    }
    public function userSubscription()
    {
        return $this->hasOne(UserSubscription::class,'user_id','user_id');
    }
    public function getAgeAttribute()
    {
        $date = strtotime($this->date_of_Birth);
        $date = date('Y-M-d',$date);
        $age = Carbon::parse($date)->age;
        return $age;
    }
//    public function sender()
//    {
//        return $this->belongsTo(User::class,'sender_id','user_id')->with('picture')->with('profileViewedYou')->with('profileYouViewed')->with('userPlan');
//    }
//    public function receiver()
//    {
//        return $this->belongsTo(User::class,'receiver_id','user_id')->with('picture')->with('profileViewedYou')->with('profileYouViewed')->with('userPlan');
//    }
//    public function getSenderNameAttribute()
//    {
//        return $this->sender->first_name.' '.last_name;
//    }
//    public function getReceiverNameAttribute()
//    {
//        return $this->receiver->first_name.' '.last_name;
//    }
}
