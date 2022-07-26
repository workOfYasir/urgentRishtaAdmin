<?php

namespace App\Http\Controllers;

use App\Models\Religion;
use Illuminate\Http\Request;

class ReligionController extends Controller
{
    public function store(Request $request)
    {
        $id = Religion::insertGetId($request->data);
        $data = Religion::find($id);
        return response()->json([
            ['added religion' => $data],
            200,
        ]);
    }
    public function update(Request $request)
    {
        $data = Religion::find($request->data['id']);
        $data->update($request->data);
        return response()->json([
            ['updated religion' => $data],
            200,
        ]);

    }
    public function delete(Request $request)
    {
        $user = Religion::find($request->id);
        $user->delete();
    }
    public function getReligion(Request $request)
    {
        $religion = Religion::where('id',$request->id)->get();
        return response()->json([
            ['religion' => $religion],
            200,
        ]);
    }
    public function getReligions()
    {
        $religion = Religion::get();
        return response()->json([
            'religions' => $religion
        ]);
    }
}
