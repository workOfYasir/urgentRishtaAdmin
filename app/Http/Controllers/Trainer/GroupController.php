<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\WorkoutPlan;
use App\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index(){
        $groups= Group::all();
        return response()->json(['grous',$groups]);
    }

    public function addGroup(Request $request){
        Group::create($request->all());
        $groups= Group::all();
        return response()->json(['grous',$groups]);
    }

    public function groupMembers($id){
        $users= User::whereHas("roles", function($q){ $q->where("name", "client"); })->get();
        $group_user= Group::find($id)->with('groupUser')->get();
        return response()->json(['user'=>$users,'$group_user'=>$group_user]);
    }
    public function addMembers(Request $request){
        $group_user=Group::findorfail($request->group_id);
        $group_user->groupUser()->attach($request->user);
        return $this->index();
    }

    
    
}
