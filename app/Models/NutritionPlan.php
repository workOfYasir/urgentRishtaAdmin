<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NutritionPlan extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable=['name'];

    //days array
    const Days=['Sunday','Monday','Tuesday','Wednesday','Thusday','Friday','Saturday'];
}
