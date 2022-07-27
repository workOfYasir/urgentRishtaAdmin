<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function store(Request $request)
    {
        $id = Profile::insertGetId($request->data);
        $data = Profile::find($id);
        return response()->json([
            ['addedProfile' => $data],
            200,
        ]);
    }
    public function update(Request $request)
    {
        $data = Profile::where('user_id',$request->data['id']);
        $data->update($request->data);
        return response()->json([
            ['updatedProfile' => $data],
            200,
        ]);

    }
    public function delete(Request $request)
    {
        $user = Profile::find($request->id);
        $user->delete();
    }
    public function getProfile(Request $request)
    {
        $user = Profile::where('id',$request->id)->with('user')->with('country')->with('state')->with('sector')->with('city')->with('religion')->with('cast')->get();
        return response()->json($user);
    }
    public function getProfiles()
    {
        $user = Profile::with('user')->with('country')->with('sector')->with('city')->with('religion')->with('cast')->get();
        return response()->json([
            ['profiles' => $user],
            200,
        ]);
    }
}
