<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable=[ 'price', 'discount', 'messages', 'view_contacts', 'standout_profile', 'valid_til'];
}
