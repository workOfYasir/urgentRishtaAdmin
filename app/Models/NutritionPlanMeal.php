<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Meal;
class NutritionPlanMeal extends Model
{
    /**
     * @return BelongsTo
     */
    public function dish()
    {
        return $this->belongsTo(Meal::class, 'meal_id');
    }

}
