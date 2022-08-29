<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'user_profiles';

    protected $fillable= ['user_id', 'city_id', 'religion_id', 'sector_id', 'cast_id', 'country_id', 'first_name', 'last_name', 'gender', 'age', 'date_of_Birth', 'marital_status', 'height', 'On_behalf', 'star', 'disability', 'blood_group', 'current_residency_country', 'state_of_residency', 'city', 'town', 'number', 'whatsapp_number', 'hobbies', 'interest', 'qualification', 'working_with', 'company_name', 'no_of_brothers', 'no_of_sister', 'family_type', 'father_status', 'mother_status', 'brother_marital_status', 'family_address', 'martial_status', 'living_with_family', 'annual_income', 'about','profile_viewed','view_contacts','pictures_settings'];    

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id')->with('picture')->with('profileViewedYou')->with('profileYouViewed')->with('userPlan');
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
        return $this->hasOne('App\Models\Cast'::class,'id', 'cast_id');
    }
    public function country()
    {
        return $this->hasOne('App\Models\Country'::class,'id','country_id');
    }
    public function userSubscription()
    {
        return $this->hasOne('App\Models\UserSubscription'::class,'user_id','user_id');
    }

}
