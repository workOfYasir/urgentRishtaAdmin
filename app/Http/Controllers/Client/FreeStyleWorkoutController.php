<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\FreeStyleExercise;
use App\Models\FreeStyleWorkout;
use App\Models\News;
use Illuminate\Http\Request;

class FreeStyleWorkoutController extends Controller
{
    public function store(Request $request){
        $workout=FreeStyleWorkout::create($request->all());
        $input=$request->all();
        $input['workout_id']=$workout->id;
        
        FreeStyleExercise::create($input);
        News::create([
            'model_type'=>'App\Models\FreeStyleWorkout',
            'model_id'=>$workout->id,
        ]);
        return response()->json(['Workout Added']);
    }
}
