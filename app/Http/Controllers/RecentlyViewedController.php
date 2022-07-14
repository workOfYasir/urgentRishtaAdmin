<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Models\RecentlyViewed;
use Illuminate\Support\Facades\Auth;

class RecentlyViewedController extends Controller
{
    public function store(Request $request)
    {
        $id = RecentlyViewed::insertGetId($request->data);
        $data = RecentlyViewed::find($id);
        return response()->json([
            ['RecentlyViewed' => $data],
            200,
        ]);
    }
    public function profilesYouVisited()
    {   $id = Auth::user()->id;
        $data = User::where('id',$id)->with('profileYouViewed')->get()->toArray();
        return response()->json([
            ['profilesYouVisited' => $data],
            200,
        ]);
    }
    public function profilesVisitedYou()
    {   $id = Auth::user()->id;
        $data = User::where('id',$id)->with('profileViewedYou')->get()->toArray();
        return response()->json([
            ['profilesVisitedYou' => $data],
            200,
        ]);
    }

}
