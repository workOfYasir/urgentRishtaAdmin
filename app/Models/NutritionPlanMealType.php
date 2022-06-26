<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NutritionPlanMealType extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable=['weekly_plan_id','name','time'];
    /**
     * @return BelongsTo
     */
    public function meal()
    {
        return $this->belongsToMany(Meal::class,'nutrition_plan_meals','type_id','meal_id');
    }

}
