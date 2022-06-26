<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\AssessmentType;
use App\Models\FreeStyleWorkout;
use App\Models\News;
use App\Models\NewsLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Exception;

class AssessmentController extends Controller
{
    public function assessmentType(){
        $client_id=auth()->user()->id;
        $assessment= AssessmentType::with(['lastAssessment' => function ($query) use ($client_id){
            $query->where('client_id',$client_id)->select('type_id','assessment');
        }])->get();
        return response()->json(['assessment'=>$assessment]);
        // $model = new FreeStyleWorkout;
         
        // $input = $model->find(1);
       
        // $input['ok1']=$input->relation()->get();
        //     return $input;
       
    }

    public function assessment($id){
        $client_id=auth()->user()->id;
        $assessment=Assessment::where('client_id',$client_id)->where('type_id',$id)->orderBy('date','desc')->get();
        return response()->json(['assessment'=>$assessment]);
    }

    public function addAssessment(Request $request){
        $validator = Validator::make($request->all(), [ 
            'type_id' => 'required',
            'date' => 'required',
            'assessment'=>'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        try{
            $input=$request->all();
            $input['client_id']=auth()->user()->id;
            
            Assessment::create($input);
            return response()->json(['Added']);
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
       
        
    }
    public function update(Request $request){
        $validator = Validator::make($request->all(), [ 
            'type_id' => 'required',
            'date' => 'required',
            'assessment'=>'required',
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        try{
            $input=$request->all();
            $input['client_id']=auth()->user()->id;
            
            Assessment::where('client_id',$input['client_id'])->where('type_id',$request->type_id)
            ->where('date',$request->date)
            ->update($input);
            return response()->json(['Added']);
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
       
        
    }
}
