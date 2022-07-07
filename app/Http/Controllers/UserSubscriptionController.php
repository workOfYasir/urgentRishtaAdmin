<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;

class UserSubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $id = UserSubscription::insertGetId($request->data);
        $data = UserSubscription::find($id);
        return response()->json([
            ['added user' => $data],
            200,
        ]);
    }
    public function userPlan()
    {
        $id = Auth::user()->id;
        $user = User::where('id',$id)->with('userPlan')->get();
        dd($user);
    }
}
