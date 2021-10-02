<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wall;

class WallController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Wall::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Wall::all();
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
            'location_id' => 'required|filled|numeric',
            'name' => 'required|filled|string',
            'order' => 'numeric|nullable'
        ]);

        $wallData = [
            'location_id' => $request->input('location_id'),
            'name' => $request->input('name')
        ];

        if ($request->input('order')) {
            $wallData['order'] = $request->input('order');
        }

        $wall = Wall::create($wallData);

        return $wall;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wall  $wall
     * @return \Illuminate\Http\Response
     */
    public function show(Wall $wall)
    {
        return $wall;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wall          $wall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wall $wall)
    {
        $request->validate([
            'location_id' => 'required|filled|numeric',
            'name' => 'required|filled|string',
            'order' => 'numeric|nullable'
        ]);

        if ($request->input('location_id')) {
            $wall->location_id = (int) $request->input('location_id');
        }

        if ($request->input('name')) {
            $wall->name = $request->input('name');
        }

        if ($request->input('order')) {
            $wall->order = $request->input('order');
        }

        $wall->save();

        return $wall;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wall  $wall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wall $wall)
    {
        return $wall->delete();
    }
}
