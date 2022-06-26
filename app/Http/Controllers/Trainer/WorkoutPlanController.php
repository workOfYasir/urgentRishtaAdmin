<?php

namespace App\Http\Controllers\Trainer;

use App\AssignWorkout;
use App\Http\Controllers\Controller;
use App\Models\AssignWorkout as ModelsAssignWorkout;
use App\Models\NutritionPlan;
use App\Models\WorkoutPlan;
use App\Models\WorkoutPlanNote;
use App\Models\WorkoutPlanType;
use App\Models\WorkoutPlanWeekly;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkoutPlanController extends Controller
{
     /**
     * Nutrition plans
     */
    public function index(){
        
        $workout= WorkoutPlan::get();
        return response()->json(['workout'=>$workout]);
    }
     /**
     * Number Of weeks in workout template
     */
    Public function allWorkoutTemplateWeeks($id){
      
        WorkoutPlan::findorfail($id);
        $workout= WorkoutPlanWeekly::where('plan_id',$id)->get()->unique('week');
        $count= $workout->count();
        return response()->json([
            'count'=>$count,
            'workout'=>$workout
        ]);
        
        // return response()->json(['workoutTemplate'=>  $workoutTemplate]);
    }
    /**
     * Store nutrtion plan
     */
    public function addWorkoutPlan(Request $request){
        $validator = Validator::make($request->all(), [ 
            'name'=>'required' 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        try{ 
           $input=$request->all();
            $nutrtion=WorkoutPlan::create($input);
            $array=NutritionPlan::Days;
            foreach($array as $item){
                $weeklyPlan= WorkoutPlanWeekly::create([
                    'plan_id'=>$nutrtion->id,
                    'week'=>1,
                    'day'=>$item,
                ]);
            }
            $workoutPlan= WorkoutPlan::get();
            return response()->json(['workout_plan'=>$workoutPlan]);
        }catch(Exception $e){
            return response()->json(['Error',401]);
        }
    }
    /**
     * Workout plans data
     */
    public function workoutPlanData($id){
        $workoutPlan= WorkoutPlanWeekly::where('plan_id',$id)->get();
        return response()->json(['workout_plan'=>$workoutPlan]);
    }


    public function weekAdd($id){
      
        try{ 
          
            $array=NutritionPlan::Days;
            $check= WorkoutPlanWeekly::where('plan_id',$id)->first();
            
            foreach($array as $item){
                $weeklyPlan= WorkoutPlanWeekly::create([
                    'plan_id'=>$id,
                    'week'=>$check->week+1,
                    'day'=>$item,
                ]);
            }
            $workoutPlan= WorkoutPlan::get();
            return response()->json(['workout_plan'=>$workoutPlan]);
        }catch(Exception $e){
            return response()->json(['Error',401]);
        }
    }
    /**
     * workout plan data daily
     */
    public function workoutPlanDataDaily($id){
      
        $workout_plan= WorkoutPlanWeekly::findorfail($id);
        $weeks= WorkoutPlanWeekly::where('plan_id',$workout_plan->plan_id)->get(['id','day']);
        $workout= WorkoutPlanType::where('week_id',$id)->with('exercise')->get();

        return response()->json([
            'weeks'=>$weeks,
            'workout'=>$workout,
        ]);
    }
    /**
     * add excersice in workoutPlan
     */
    public function addExcersice(Request $request){
        $validator = Validator::make($request->all(), [ 
            'week_id'=>'required' 
            
            
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
      
       try{
            $workout= WorkoutPlanType::create([
                'week_id'=>$request->week_id,
                'name'=>'Exercise',
            ]);
            $workout->exercise()->attach($request->exercise_id);
            return $this->workoutPlanDataDaily($request->week_id);
       }catch(Exception $e){
            return response()->json(['Error',401]);
       }
        
    }
    /**
     * edit Exercise
     */
    public function editExercise($type_id,$exercise_id){
        try{
             $workout = WorkoutPlanType::findorfail($type_id);
             $exercise=$workout->exercise()
                     ->newPivotStatement()
                     ->where('type_id',$type_id)
                     ->where('exercise_id', $exercise_id)
                     ->get();        
             return response()->json(['workout'=>$exercise]);
         }catch(Exception $e){
             return response()->json([$e,'There are some Error'],401);
         }
     }
    /**
     * edit Exercise
     */
    public function updateExercise(Request $request){
        try{
           
             $workout = WorkoutPlanType::findorfail($request->type_id);
             $exercise=$workout->exercise()
                     ->newPivotStatement()
                     ->where('type_id',$request->type_id)
                     ->where('exercise_id', $request->exercise_id)
                     ->update($request->all());        
             return response()->json(['Updated ']);
         }catch(Exception $e){
             return response()->json([$e,'There are some Error'],401);
         }
    }

    /**
     * Add Superset
     */
    public function addSuperSet(Request $request){
        $validator = Validator::make($request->all(), [ 
            'workout_id'=>'required' 
            
            
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
      
       try{
            $workout= WorkoutPlanType::create([
                'workout_id'=>$request->workout_id,
                'name'=>'Superset',
            ]);
            $workout->exercise()->attach($request->exercise_id);
            return $this->allWorkout($request->workout_id);
       }catch(Exception $e){
            return response()->json(['Error',401]);
       }
        
    }
    /**
     * Add Circuit
     */
    public function addCircuit(Request $request){
        $validator = Validator::make($request->all(), [ 
            'workout_id'=>'required' 
            
            
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
      
       try{
            $workout= WorkoutPlanType::create([
                'workout_id'=>$request->workout_id,
                'name'=>'Circuit',
            ]);
            $workout->exercise()->attach($request->exercise_id);
            return $this->allWorkout($request->workout_id);
       }catch(Exception $e){
            return response()->json(['Error',401]);
       }
        
    }
    /**
     * Add Exercise Superset and circuit
     */
    public function addExcersiceSuperset(Request $request){
        $validator = Validator::make($request->all(), [ 
            'id'=>'required' 
            
            
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
      
       try{
            $workout= WorkoutPlanType::find($request->id);
            $workout->exercise()->attach($request->exercise_id);
            return $this->allWorkout($workout->workout_id);
        }catch(Exception $e){
            return response()->json(['Error',401]);
        }
        
    }
    /**
     * Edit notes Superset and circuit
     */
    public function editNotesSuperset($id){
       
      
       try{
            $workout= WorkoutPlanType::find($id);
           
            return response()->json(['notes_sets'=>$workout]);
        }catch(Exception $e){
            return response()->json(['Error',401]);
        }
        
    }
    /**
     * update notes Superset and circuit
     */
    public function updateNotesSuperset(Request $request){
        $validator = Validator::make($request->all(), [ 
            'id'=>'required',
            'sets'=>'required',
            'note'=>'required'
            
            
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
      
       try{
            $workout=WorkoutPlanType::findorfail($request->id);
            WorkoutPlanType::findorfail($request->id)->update([
                'sets'=>$request->sets,
                'note'=>$request->note,
            ]);
        //    return 1;
             return $this->allWorkout($workout->workout_id);
        }catch(Exception $e){
            return response()->json(['Error',401]);
        }
        
    }

    /**
     * Store notes
     */
    public function addNote(Request $request){
        $validator = Validator::make($request->all(), [ 
            'workout_id'=>'required|unique:workout_notes',
            'notes'=>'required' 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
      
       try{
          
            WorkoutPlanNote::create($request->all());
        //    return 1;
             return $this->allWorkout($request->workout_id);
        }catch(Exception $e){
            return response()->json(['Error',401]);
        }
    }
    public function updateNote(Request $request){
        $validator = Validator::make($request->all(), [ 
            'id'=>'required',
            'notes'=>'required' 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
      
       try{
            $workout=WorkoutPlanNote::findorfail($request->id);
            WorkoutPlanNote::findorfail($request->id)->update($request->all());
        //    return 1;
             return $this->allWorkout($workout->workout_id);
        }catch(Exception $e){
            return response()->json(['Error',401]);
        }
    }
    /**
     * Edit
     */
    public function editNote($id){
        
      
       try{
            $workout=WorkoutPlanNote::findorfail($id);
             return response()->json(['notes'=>$workout]);
        }catch(Exception $e){
            return response()->json(['Error',401]);
        }
    }
    /**
     * Delete
     */
    public function deleteNote($id){
        
      
        try{
             $workout=WorkoutPlanNote::findorfail($id);
             WorkoutPlanNote::findorfail($id)->delete();
             return $this->allWorkout($workout->workout_id);
         }catch(Exception $e){
             return response()->json(['Error',401]);
         }
    }


    /**
     * Assign WorkoutPlan Week
     */
    public function assignWorkout(Request $request){
        $validator = Validator::make($request->all(), [ 
            'plan_id'=>'required',
            'week_id'=>'required',
            'start_date'=>'required',
             
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
      
       try{
            foreach($request->client_id as $item){
                $assignWorkout= ModelsAssignWorkout::create([
                    'plan_id'=>$request->plan_id,
                    'week_id'=>$request->week_id,
                    'client_id'=>$item,
                    'start_date'=>$request->start_date,
                    'is_delete'=>$request->is_delete,
                ]);
            }
             return response()->json(['Added',200]);
        }catch(Exception $e){
            return response()->json(['Error',401]);
        }
    }
}
