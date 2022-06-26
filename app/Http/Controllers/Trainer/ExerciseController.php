<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exercise;
use Illuminate\Support\Facades\Validator;


class ExerciseController extends Controller
{
    Public function index(){
      
        $exercise= Exercise::get();
       
        return response()->json(['exercise'=>$exercise]);
    }

    /**
     * Add Exercise
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'type' => 'required', 
            'video' => 'required',
            
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
      
        $exercise = new Exercise();
        
        $exercise->name= $request->name;
        $exercise->type=$request->type;
        $exercise->video=$request->video;
        $exercise->notes=$request->notes;
        $exercise->save();
        return response()->json(['Excercise Added',200]);
        
    }

    /**
     * edit 
     */
    public function edit($id){
        $exercise= Exercise::whereId($id)->get();
        return response()->json(['exercise'=>$exercise]);
    }
     /**
     * Add Exercise
     */
    public function update(Request $request){
       
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'type' => 'required', 
            'video' => 'required',
            
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
      
        $exercise =Exercise::whereId($request->id)->update([
            'name'=> $request->name,
           'type'=>$request->type,
            'video'=>$request->video,
           'notes'=>$request->note,
        ]);
        
      
        return response()->json(['Excercise Updated',200]);
        
    }
}

