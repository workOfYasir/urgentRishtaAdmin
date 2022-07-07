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
            ['added user' => $data],
            200,
        ]);
    }
    public function profilesYouVisied()
    {   $id = Auth::user()->id;
        $data = User::where('id',$id)->with('profileYouViewed')->get()->toArray();
        dd($data);
    }
    public function profilesVisiedYou()
    {   $id = Auth::user()->id;
        $data = User::where('id',$id)->with('profileViewedYou')->get()->toArray();
        dd($data);
    }

}
