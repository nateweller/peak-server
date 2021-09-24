<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GradingSystem;

class GradingSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GradingSystem::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user('api');

        if (! $user) abort(401, 'Unauthenticated.');

        $request->validate([
            'organization_id' => 'required|filled|numeric',
            'name' => 'string|required|filled',
            'discipline' => 'string|required|filled'
        ]);
        
        if (! $user->organizations->contains($request->input('organization_id'))) {
            abort(403, 'Unauthorized action.');
        }

        $gradingSystem = GradingSystem::create([
            'organization_id' => (int) $request->input('organization_id'),
            'name' => $request->input('name'),
            'discipline' => $request->input('discipline')
        ]);

        return $gradingSystem;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GradingSystem  $gradingSystem
     * @return \Illuminate\Http\Response
     */
    public function show(GradingSystem $gradingSystem)
    {
        return $gradingSystem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request   $request
     * @param  \App\Models\GradingSystem  $gradingSystem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GradingSystem $gradingSystem)
    {
        $request->validate([
            'name' => 'string|required|filled',
            'discipline' => 'string|required|filled'
        ]);

        if ($request->input('name')) {
            $gradingSystem->name = $request->input('name');
        }

        if ($request->input('discipline')) {
            $gradingSystem->discipline = $request->input('discipline');
        }

        $gradingSystem->save();

        return $gradingSystem;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GradingSystem  $gradingSystem
     * @return \Illuminate\Http\Response
     */
    public function destroy(GradingSystem $gradingSystem)
    {
        $gradingSystem->delete();
    }
}
