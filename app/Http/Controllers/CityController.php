<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function store(Request $request)
    {
        $id = City::insertGetId($request->data);
        $data = City::find($id);
        return response()->json([
            'added city' => $data
        ]);
    }
    public function update(Request $request)
    {
        $data = City::find($request->data['id']);
        $data->update($request->data);
        return response()->json([
            'updated city' => $data
        ]);

    }
    public function delete(Request $request)
    {
        $city = City::find($request->id);
        $city->delete();
    }
    public function getCity(Request $request)
    {
        $city = City::where('id',$request->id)->get();
        return response()->json([
            'city' => $city
        ]);
    }
    public function getCitesByStates(Request $request)
    {
        $cities = City::where('state_id',$request->state_id)->get();
        return response()->json([
            'cities' => $cities
        ]);
    }
    public function getCities()
    {
        $city = City::get();
        return response()->json(['cities' => $city]);
    }
}
