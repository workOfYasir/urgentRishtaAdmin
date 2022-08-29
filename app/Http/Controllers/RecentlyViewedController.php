<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\RecentlyViewed;
use Illuminate\Support\Facades\Auth;

class RecentlyViewedController extends Controller
{
    public function store(Request $request)
    {

        $id = RecentlyViewed::create(request()->all());
        if($request->viewed_id==Auth::user()->id){
            $authUser = Profile::where(Auth::user()->id)->first();
            $authUser->update(['profile_viewed'=>(((int)$authUser->profile_viewed)+1)]);
        }
        return response()->json([
            ['RecentlyViewed'],
            200,
        ]);
    }
    public function profilesYouVisited()
    {   $id = Auth::user()->id;
        $data = RecentlyViewed::where('viewer_id',$id)->with('profileYouViewed')->get()->toArray();
        return response()->json([
            ['profilesYouVisited' => $data],
            200,
        ]);
    }
    public function profilesVisitedYou()
    {   $id = Auth::user()->id;
        $data = RecentlyViewed::where('viewed_id',$id)->with('viewedYourProfile')->get();
        return response()->json([
            ['profilesVisitedYou' => $data],
            200,
        ]);
    }

}
