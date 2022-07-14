<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function store(Request $request)
    {
        $id = Plan::insertGetId($request->data);
        $data = Plan::find($id);
        return response()->json([
            ['addedPlan' => $data],
            200,
        ]);
    }
    public function plans()
    {
        
        $data = Plan::all();
       
        return response()->json([
            ['userPlan' => $data],
            200,
        ]);
    }
}
