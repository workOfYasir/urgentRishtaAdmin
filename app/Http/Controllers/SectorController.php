<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function store(Request $request)
    {
        $id = Sector::insertGetId($request->data);
        $data = Sector::find($id);
        return response()->json([
            ['added sector' => $data],
            200,
        ]);
    }
    public function update(Request $request)
    {
        $data = Sector::find($request->data['id']);
        $data->update($request->data);
        return response()->json([
            ['updated sector' => $data],
            200,
        ]);

    }
    public function delete(Request $request)
    {
        $sector = Sector::find($request->id);
        $sector->delete();
    }
    public function getSector(Request $request)
    {
        $sector = Sector::where('id',$request->id)->get();
        return response()->json([
            ['sector' => $sector],
            200,
        ]);
    }
    public function getSectors()
    {
        $sector = Sector::get();
        return response()->json([
            ['sectors' => $sector],
            200,
        ]);
    }
}
