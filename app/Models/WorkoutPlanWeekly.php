<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutPlanWeekly extends Model
{
    protected $fillable=['plan_id','week','day'];

    public function workoutPlanType(){
        return $this->hasMany(WorkoutPlanType::class, 'week_id')->with('excersice');
    }
}
