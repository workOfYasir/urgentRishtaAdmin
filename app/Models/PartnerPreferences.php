<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerPreferences extends Model
{
    protected $table = 'partner_prefrences';
    protected $fillable = ['user_id','max_age', 'max_height', 'min_age', 'min_height', 'martial_status', 'religion', 'mother_tongue', 'community', 'country_living_in', 'state_living_in', 'city/district', 'photo_visibilaty'];
    
    
}
