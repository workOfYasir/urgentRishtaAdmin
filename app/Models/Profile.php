<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'user_profiles';

    protected $fillable= ['user_id', 'city_id', 'religion_id', 'sector_id', 'cast_id', 'country_id', 'first_name', 'last_name', 'gender', 'age', 'date_of_Birth', 'marital_status', 'height', 'On_behalf', 'star', 'disability', 'blood_group', 'current_residency_country', 'state_of_residency', 'city', 'town', 'number', 'whatsapp_number', 'hobbies', 'interest', 'qualification', 'working_with', 'company_name', 'no_of_brothers', 'no_of_sister', 'family_type', 'father_status', 'mother_status', 'brother_marital_status', 'family_address', 'martial_status', 'living_with_family', 'annual_income', 'about'];    

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function sector()
    {
        return $this->hasOne(Sector::class,'id','sector_id');
    }
    public function city()
    {
        return $this->hasOne(City::class,'id','city_id')->with('state')->with('country');
    }
    public function religion()
    {
        return $this->hasOne(Religion::class,'id','religion_id');
    }
}
