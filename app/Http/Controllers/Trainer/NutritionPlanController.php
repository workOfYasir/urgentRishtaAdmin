<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\NutritionPlan;
use App\Models\NutritionPlanMealType;
use App\Models\WeeklyNutritionPlan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class NutritionPlanController extends Controller
{
     /**
     * Nutrition plans
     */
    public function index(){
        
        $nutritionPlan= NutritionPlan::get();
        return response()->json(['nutrition_plan'=>$nutritionPlan]);
    }
    /**
     * Store nutrtion plan
     */
    public function storeNutrtionPlan(Request $request){
        $input=$request->all();
        $nutrtion=NutritionPlan::create($input);
        $array=NutritionPlan::Days;
        foreach($array as $item){
            $weeklyPlan= WeeklyNutritionPlan::create([
                'plan_id'=>$nutrtion->id,
                'week'=>1,
                'day'=>$item,
            ]);
        }
        $nutritionPlan= NutritionPlan::get();
        return response()->json(['nutrition_plan'=>$nutritionPlan]);
    }

    /**
     * Nutrition plans data
     * @param $id nutrition plan id 
     */
    public function nutritionPlanData($id){
        $nutritionPlan= WeeklyNutritionPlan::where('plan_id',$id)->with('nutritonPlanType')->get();
        return response()->json(['nutrition_plan'=>$nutritionPlan]);
    }

    /**
     * nutrtion plan data daily
     */
    public function nutritionPlanDataDaily($id){
        $nutritionPlan= WeeklyNutritionPlan::where('id',$id)->with('nutritonPlanType')->get();
        return response()->json(['nutrition_plan'=>$nutritionPlan]);
    }
    /**
     * nutrtion plan add meal
     */
    public function addMeal(Request $request){
        
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'time' => 'required', 
            'weekly_plan_id'=>'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        try{
            $input= $request->all();
            $nutrtion = NutritionPlanMealType::create($input);
            $nutrtion->meal()->attach($request->meals);
            return response()->json(['Added']);
        }catch (Exception $e){
            return $e->getMessage();
        }
       
    }
    /**
     * nutrtion plan add meal
     */
    public function deleteMeal($id){   
        try{
            $nutrtion = NutritionPlanMealType::findorfail($id);
            $nutrtion->meal()->newPivotStatement()
            ->where('type_id',$id)
            ->delete();
            $nutrtion->delete();
            return response()->json(['Deleted']);
        }catch(Exception $e){
            return response()->json(['No Data']);
        }           
    
    }
    /**
     * nutrtion plan add meal
     */
    public function updateMeal(Request $request){   
        // try{
            $nutrtion = NutritionPlanMealType::findorfail($request->id);
            $nutrtion->update($request->all());
            $nutrtion->meal()->sync($request->meals);
            return response()->json(['Updated']);
        // }catch(Exception $e){
        //     return response()->json(['No Data']);
        // }           
    
    }
    /**
     * addFood
     */
    public function addFood(Request $request){
        $validator = Validator::make($request->all(), [ 
            'type_id' => 'required', 
            'meals'  => 'required',
           
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        try{
            
            $nutrtion = NutritionPlanMealType::findorfail($request->type_id);
            $nutrtion->meal()->sync($request->meals);
            return response()->json(['Added']);
        }catch (Exception $e){
            return $e->getMessage();
        }

    }
    /**
     * addFood
     */
    public function createFood($id){
        $nutrtion = NutritionPlanMealType::where('id',$id)->with('meal')->get();
        return response()->json(['nutrition_plan'=>$nutrtion]);

    }
    /**
     * Delete Food
     */
    public function deleteFood($type_id,$meal_id){
        $nutrtion = NutritionPlanMealType::findorfail($type_id)
                                        ->meal()
                                        ->newPivotStatement()
                                        ->where('type_id',$type_id)
                                        ->where('meal_id', $meal_id)
                                        ->delete();
        if(!$nutrtion){
            return response()->json(['Not Deleted']);
        }
        return response()->json(['Deleted']);

    }

}
