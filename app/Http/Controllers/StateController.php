<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function store(Request $request)
    {
        $id = State::insertGetId($request->data);
        $data = State::find($id);
        return response()->json([
            ['added state' => $data],
            200,
        ]);
    }
    public function update(Request $request)
    {
        $data = State::find($request->data['id']);
        $data->update($request->data);
        return response()->json([
            ['updated state' => $data],
            200,
        ]);

    }
    public function delete(Request $request)
    {
        $state = State::find($request->id);
        $state->delete();
    }
    public function getState(Request $request)
    {
        $state = State::where('id',$request->id)->get();
        return response()->json([
            ['state' => $state],
            200,
        ]);
    }
    public function getStatesByCountry(Request $request)
    {
        $states = State::where('country_id',$request->country_id)->get();
        return response()->json([
            'states' => $states
        ]);
    }
    public function getStates()
    {
        $state = State::get();
        return response()->json(['states' => $state]);
    }
}
