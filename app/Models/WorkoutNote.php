<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutNote extends Model
{
    protected $fillable=['workout_id','notes'];
}
