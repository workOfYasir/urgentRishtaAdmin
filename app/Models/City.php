<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = ['country_id', 'state_id', 'potsal_code', 'name'];

    public function country()
    {
        return $this->hasOne(Country::class,'id','country_id');
    }
    public function state()
    {
        return $this->hasOne(State::class,'id','state_id');
    }
}
