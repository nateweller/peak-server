<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Location::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'organization_id' => 'required|filled|numeric',
            'name' => 'required|filled'
        ]);

        $location = Location::create([
            'organization_id' => (int) $request->input('organization_id'),
            'name' => $request->input('name')
        ]);

        return $location;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::find($id);

        if (!$location) {
            return response()->json(['message' => 'Location not found.'], 404);
        }
        
        return $location;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'organization_id' => 'filled|numeric',
            'name' => 'filled'
        ]);

        $location = Location::find($id);

        if (!$location) {
            return response()->json(['Location not found.'], 404);
        }

        if ($request->input('organization_id')) {
            $location->organization_id = (int) $request->input('organization_id');
        }

        if ($request->input('name')) {
            $location->name = $request->input('name');
        }

        $location->save();

        return $location;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::find($id);

        if (!$location) {
            return response()->json(['message' => 'Location not found.'], 404);
        }
        
        return $location->delete();
    }
}
