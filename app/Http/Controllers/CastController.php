<?php

namespace App\Http\Controllers;

use App\Models\Cast;
use Illuminate\Http\Request;

class CastController extends Controller
{
    public function store(Request $request)
    {
        $id = Cast::insertGetId($request->data);
        $data = Cast::find($id);
        return response()->json([
            ['added cast' => $data],
            200,
        ]);
    }
    public function update(Request $request)
    {
        $data = Cast::find($request->data['id']);
        $data->update($request->data);
        return response()->json([
            ['updated cast' => $data],
            200,
        ]);

    }
    public function delete(Request $request)
    {
        $cast = Cast::find($request->id);
        $cast->delete();
    }
    public function getCast(Request $request)
    {
        $cast = Cast::where('id',$request->id)->get();
        return response()->json([
            ['cast' => $cast],
            200,
        ]);
    }
    public function getCasts()
    {
        $cast = Cast::get();
        return response()->json([
            ['casts' => $cast],
            200,
        ]);
    }
}
