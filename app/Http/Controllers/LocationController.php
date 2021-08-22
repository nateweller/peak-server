<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Location::class, 'location');
    }

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
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        return $location;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Locations     $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $request->validate([
            'organization_id' => 'filled|numeric',
            'name' => 'filled'
        ]);

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
     * @param  \App\Models\Locations  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        return $location->delete();
    }
}
