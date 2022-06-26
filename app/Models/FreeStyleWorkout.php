<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FreeStyleWorkout extends Model
{
    protected $fillable=['description','date'];
    public function relation()
    {
        return $this->hasMany(FreeStyleExercise::class,'workout_id');
    }
}
