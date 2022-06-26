<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreeStyleExercise extends Model
{
    protected $fillable=['workout_id','name','set','weight','reps','rest'];
}
