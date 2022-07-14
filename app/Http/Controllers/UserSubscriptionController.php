<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;

class UserSubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $user = User::find($request->user_id);

        $user->userPlan()->sync([$request->plan_id,$request->plan_id,$request->plan_id]);
 
        return response()->json([
            ['success' => 'user subscribed'],
            200,
        ]);
    }
    public function userPlan()
    {
        $id = Auth::user()->id;
        $data = User::where('id',$id)->with('userPlan')->get();
        return response()->json([
            ['userPlan' => $data],
            200,
        ]);
    }
    
}
