<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClimbColor;

class ClimbColorController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(ClimbColor::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClimbColor::all();
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
            'name' => 'string|filled|required',
            'color' => 'string|filled|required'
        ]);

        $climbColor = ClimbColor::create([
            'name' => $request->input('name'),
            'color' => $request->input('color')
        ]);

        return $climbColor;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClimbColor  $climbColor
     * @return \Illuminate\Http\Response
     */
    public function show(ClimbColor $climbColor)
    {
        return $climbColor;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClimbColor     $climbColor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClimbColor $climbColor)
    {
        $request->validate([
            'name' => 'string|filled',
            'color' => 'string|filled'
        ]);

        if ($request->input('name')) {
            $climbColor->name = $request->input('name');
        }

        if ($request->input('color')) {
            $climbColor->color = $request->input('color');
        }

        $climbColor->save();

        return $climbColor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClimbColor  $climbColor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Climb $climbColor)
    {
        return $climbColor->delete();
    }
}
