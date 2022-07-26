<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function store(Request $request)
    {
        $id = Country::insertGetId($request->data);
        $data = Country::find($id);
        return response()->json([
            ['addedCountry' => $data],
            200,
        ]);
    }
    public function update(Request $request)
    {
        $data = Country::find($request->data['id']);
        $data->update($request->data);
        return response()->json([
            ['updatedCountry' => $data],
            200,
        ]);

    }
    public function delete(Request $request)
    {
        $country = Country::find($request->id);
        $country->delete();
    }
    public function getCountry(Request $request)
    {
        $country = Country::where('id',$request->id)->get();
        return response()->json([
            ['country' => $country],
            200,
        ]);
    }
    public function getCountrys()
    {
        $country = Country::get();
        return response()->json([
            ['countrys' => $country]
        ]);
    }
}
