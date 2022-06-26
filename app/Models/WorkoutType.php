<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutType extends Model
{
    protected $fillable=['workout_id','name','sets','note'];
    public function exercise()
    {
        return $this->belongsToMany(Exercise::class,'workout_type_excersice','type_id','exercise_id')->withPivot('set');
    }
}
