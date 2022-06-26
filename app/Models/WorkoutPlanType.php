<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutPlanType extends Model
{   
    protected $fillable=['week_id','name','sets','note'];
    public function exercise()
    {
        return $this->belongsToMany(Exercise::class,'workout_plan_type_excersice','type_id','exercise_id');
    }
}
