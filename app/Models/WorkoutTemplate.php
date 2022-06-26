<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutTemplate extends Model
{
    public function workoutType(){
        return $this->hasMany(WorkoutType::class, 'workout_id')->with('exercise');
    }
    public function workoutNotes(){
        return $this->hasMany(WorkoutNote::class, 'workout_id');
    }
}
