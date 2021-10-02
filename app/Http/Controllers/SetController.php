<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Set;

class SetController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Set::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Set::all();
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
            'wall_id' => 'required|filled|numeric',
            'date' => 'date|nullable',
        ]);

        $setData = [
            'wall_id' => $request->input('wall_id'),
            'date' => $request->input('date')
        ];

        $set = Set::create($setData);

        return $set;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function show(Set $set)
    {
        return $set;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Set          $set
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Set $set)
    {
        $request->validate([
            'wall_id' => 'numeric|required|filled',
            'date' => 'date|nullable'
        ]);

        if ($request->input('wall_id')) {
            $set->wall_id = (int) $request->input('wall_id');
        }

        if ($request->input('date')) {
            $set->date = $request->input('date');
        }

        $set->save();

        return $set;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Set  $set
     * @return \Illuminate\Http\Response
     */
    public function destroy(Set $set)
    {
        return $set->delete();
    }
}
