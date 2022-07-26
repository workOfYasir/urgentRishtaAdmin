<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function store(Request $request)
    {
        $id = Community::insertGetId($request->data);
        $data = Community::find($id);
        return response()->json([
            ['added sector' => $data],
            200,
        ]);
    }
    public function update(Request $request)
    {
        $data = Community::find($request->data['id']);
        $data->update($request->data);
        return response()->json([
            ['updated sector' => $data],
            200,
        ]);

    }
    public function delete(Request $request)
    {
        $sector = Community::find($request->id);
        $sector->delete();
    }
    public function getCommunity(Request $request)
    {
        $sector = Community::where('id',$request->id)->get();
        return response()->json([
            ['sector' => $sector],
            200,
        ]);
    }
    public function getCommunitys()
    {
        $sector = Community::get();
        return response()->json([
            ['sectors' => $sector],
            200,
        ]);
    }
}
