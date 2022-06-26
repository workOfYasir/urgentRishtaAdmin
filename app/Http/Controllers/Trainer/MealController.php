<?php

namespace App\Http\Controllers\Trainer;
use App\Models\Meal;
use App\Models\NutritionPlan;
use App\Models\WeeklyNutritionPlan;
use App\Models\NutritionPlanMealType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class MealController extends Controller
{
    Public function index($id){
        // $meal= NutritionPlanMealType::with('meal')->get();
        $meal= Meal::get();
       
        return response()->json(['meal'=>$meal]);
    }

    /**
     * Add Meal
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'recipe' => 'required', 
            'calories' => 'required',
            
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
      
        $meal = new Meal();
        
        $meal->meal_name= $request->name;
        $meal->meal_recipe=$request->recipe;
        $meal->calories=$request->calories;
        $meal->notes=$request->notes;
        $meal->save();
        return response()->json(['Meal Added',200]);
        
    }

    /**
     * edit 
     */
    public function edit($id){
        $meal= Meal::whereId($id)->get();
        return response()->json(['Meal'=>$meal]);
    }
     /**
     * Add Meal
     */
    public function update(Request $request){
       
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'recipe' => 'required', 
            'calories' => 'required',
            
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
      
        $meal =Meal::whereId($request->id)->update([
            'meal_name'=> $request->name,
           'meal_recipe'=>$request->calories,
            'calories'=>$request->calories,
           'notes'=>$request->notes,
        ]);
        
      
        return response()->json(['Meal Updated',200]);
        
    }


    /**
     * Nutrition plans
     */
    public function nutritionPlan(){
        $NutritionPlan= NutritionPlan::get();
        return response()->json(['nutrition_plan'=>$NutritionPlan]);
    }

    /**
     * Nutrition plans data
     * @param $id nutrition plan id 
     */
    public function nutritionPlanData($id){
        $meal= WeeklyNutritionPlan::where('plan_id',$id)->with('nutritonPlanType')->get();
    }
}
