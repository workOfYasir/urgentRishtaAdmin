<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AssignWorkout;
use App\Models\News;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
class AssignWorkoutController extends Controller
{
    public function dueWorkoutDays(){
        $client_id=Auth::user()->id;
        $assign= AssignWorkout::where('client_id',$client_id)->latest()->take(1)->get();
        $date=$assign[0]->start_date;
        $diff = now()->diffInDays(Carbon::parse($date));
        if($diff <= 7){
            return response()->json(['Due'=>$diff]);
        }else{
            if($date<now()){
                return response()->json(['Over Due'=>$diff]);
            }else{
                return response()->json(['Due'=>$diff]);
            }
            
        }

       
        
    }
    public function dueWorkout(){
        $client_id=Auth::user()->id;
        $assign= AssignWorkout::where('client_id',$client_id)->latest()->take(1)->get();
        $date=$assign[0]->start_date;
        $diff = now()->diffInDays(Carbon::parse($date));
        if($diff <= 7){
            return response()->json(['Due'=>$assign]);
        }else{
            if($date<now()){
                return response()->json(['Over Due'=>$diff]);
            }else{
                return response()->json(['Due'=>$diff]);
            }
            
        }
        
    }
}
