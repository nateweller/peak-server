<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Climb;

class ClimbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Climb::all();
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
            'name' => 'required|filled',
            'grade' => 'string|nullable',
            'discipline' => 'required|filled',
            'color' => 'string|nullable',
            'created_at' => 'date|filled'
        ]);

        $climb = Climb::create([
            'location_id' => (int) $request->input('location_id'),
            'name' => $request->input('name'),
            'grade' => $request->input('grade'),
            'discipline' => $request->input('discipline'),
            'color' => $request->input('color')
        ]);

        return $climb;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Climb  $climb
     * @return \Illuminate\Http\Response
     */
    public function show(Climb $climb)
    {
        return $climb;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Climb         $climb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Climb $climb)
    {
        $request->validate([
            'location_id' => 'required|filled|numeric',
            'name' => 'required|filled',
            'grade' => 'string|nullable',
            'discipline' => 'required|filled',
            'color' => 'string|nullable',
            'created_at' => 'date|filled'
        ]);

        if ($request->input('location_id')) {
            $climb->location_id = (int) $request->input('location_id');
        }

        if ($request->input('name')) {
            $climb->name = $request->input('name');
        }

        if ($request->input('grade')) {
            $climb->grade = $request->input('grade');
        }

        if ($request->input('discipline')) {
            $climb->discipline = $request->input('discipline');
        }

        if ($request->input('color')) {
            $climb->color = $request->input('color');
        }

        if ($request->input('created_at')) {
            $climb->created_at = $request->input('created_at');
        }

        $climb->save();

        return $climb;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Climb $climb
     * @return \Illuminate\Http\Response
     */
    public function destroy(Climb $climb)
    {
        return $climb->delete();
    }
}
