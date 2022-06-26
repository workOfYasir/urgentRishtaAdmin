<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\WorkoutNote;
use Illuminate\Http\Request;
use App\Models\WorkoutTemplate;
use App\Models\WorkoutType;
use Exception;
use Illuminate\Support\Facades\Validator;

class WorkoutController extends Controller
{
    Public function allWorkoutTemplate(){
      
        $workoutTemplate= WorkoutTemplate::get();
        
        return response()->json(['workoutTemplate'=>  $workoutTemplate]);
    }
   
    /**
     * Add Exercise
     */
    public function storeWorkoutTemplate(Request $request){
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            
            
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
      
        $workout = new WorkoutTemplate();
        
        $workout->name= $request->name;
        $workout->save();
        return $this->allWorkoutTemplate();
        
    }
    /**
     * All Workouts
     */
    public function allWorkout($id){
        try{
            $workoutTemplate= WorkoutTemplate::where('id',$id)->with('workoutNotes')->with('workoutType')->get();
            return response()->json(['workout'=>$workoutTemplate,200]);
        }catch(Exception $e){
            return response()->json(['Error',400]);

        }
    }
    /**
     * add excersice in workout
     */
    public function addExcersice(Request $request){
        $validator = Validator::make($request->all(), [ 
            'workout_id'=>'required' 
            
            
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
      
       try{
            $workout= WorkoutType::create([
                'workout_id'=>$request->workout_id,
                'name'=>'Exercise',
            ]);
            $workout->exercise()->attach($request->exercise_id);
            return $this->allWorkout($request->workout_id);
       }catch(Exception $e){
            return response()->json(['Error',401]);
       }
        
    }
    /**
     * Delete Exercise
     */
    public function deleteExercise($type_id,$exercise_id){
       try{
            $workout = WorkoutType::findorfail($type_id);
            $workout->exercise()
                    ->newPivotStatement()
                    ->where('type_id',$type_id)
                    ->where('exercise_id', $exercise_id)
                    ->delete();
            $workout->delete();        
            return $this->allWorkout($workout->workout_id);
        }catch(Exception $e){
            return response()->json([$e,'There are some Error'],401);
        }
    }
    /**
     * edit Exercise
     */
    public function editExercise($type_id,$exercise_id){
       try{
            $workout = WorkoutType::findorfail($type_id);
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
           
             $workout = WorkoutType::findorfail($request->type_id);
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
            $workout= WorkoutType::create([
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
            $workout= WorkoutType::create([
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
            $workout= WorkoutType::find($request->id);
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
            $workout= WorkoutType::find($id);
           
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
            $workout=WorkoutType::findorfail($request->id);
            WorkoutType::findorfail($request->id)->update([
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
          
            WorkoutNote::create($request->all());
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
            $workout=WorkoutNote::findorfail($request->id);
            WorkoutNote::findorfail($request->id)->update($request->all());
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
            $workout=WorkoutNote::findorfail($id);
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
             $workout=WorkoutNote::findorfail($id);
             WorkoutNote::findorfail($id)->delete();
             return $this->allWorkout($workout->workout_id);
         }catch(Exception $e){
             return response()->json(['Error',401]);
         }
     }

    
        
    

}
