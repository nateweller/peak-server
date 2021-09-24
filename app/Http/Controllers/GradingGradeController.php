<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GradingSystem;
use App\Models\GradingGrade;

class GradingGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return GradingGrade::all();
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
            'grading_system_id' => 'required|filled|numeric',
            'name' => 'string|required|filled|unique:grading_grades',
            'order' => 'numeric|required|filled'
        ]);
        
        $gradingSystem = GradingSystem::find($request->input('grading_system_id'));

        if (! $gradingSystem) {
            abort(400, 'Provided grading system does not exist.');
        }

        if (! $gradingSystem->organization->users->contains($user->id)) {
            abort(403, 'Unauthorized action.');
        }

        $gradingGrade = GradingGrade::create([
            'grading_system_id' => (int) $request->input('grading_system_id'),
            'name' => $request->input('name'),
            'order' => $request->input('order')
        ]);

        return $gradingGrade;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GradingGrade  $gradingGrade
     * @return \Illuminate\Http\Response
     */
    public function show(GradingGrade $gradingGrade)
    {
        return $gradingGrade;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request   $request
     * @param  \App\Models\GradingGrade  $gradingGrade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GradingGrade $gradingGrade)
    {
        $request->validate([
            'name' => 'string|required|filled',
            'order' => 'numeric|required|filled'
        ]);

        if ($request->input('name')) {
            $gradingGrade->name = $request->input('name');
        }

        if ($request->input('order')) {
            $gradingGrade->order = $request->input('order');
        }

        $gradingGrade->save();

        return $gradingGrade;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GradingGrade  $gradingGrade
     * @return \Illuminate\Http\Response
     */
    public function destroy(GradingGrade $gradingGrade)
    {
        $gradingGrade->delete();
    }
}
