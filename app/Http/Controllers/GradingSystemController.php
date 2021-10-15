<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GradingSystem;
use App\Models\GradingGrade;

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
            'discipline' => 'string|required|filled',
            'grades' => 'array',
            'grades.*.name' => 'string|required|filled',
            'grades.*.id' => 'numeric'
        ]);
        
        if (! $user->organizations->contains($request->input('organization_id'))) {
            abort(403, 'Unauthorized action.');
        }

        return DB::transaction(function () use ($request) {

            $gradingSystem = GradingSystem::create([
                'organization_id' => (int) $request->input('organization_id'),
                'name' => $request->input('name'),
                'discipline' => $request->input('discipline')
            ]);

            if (! empty($request->input('grades'))) {
                foreach ($request->input('grades') as $loopIndex => $grade) {
                    GradingGrade::updateOrCreate(
                        [ 'id' => $grade['id'] ?? null ],
                        [
                            'grading_system_id' => $gradingSystem->id,
                            'name' => $grade['name'],
                            'order' => $loopIndex
                        ]
                    );
                }
            }
            
            return $gradingSystem;

        });

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

        return DB::transaction(function () use ($gradingSystem, $request) {
            $gradingSystem->save();

            if (! empty($request->input('grades'))) {
                $grade_ids;
                foreach ($request->input('grades') as $loopIndex => $grade) {
                    $gradingGrade = GradingGrade::updateOrCreate(
                        [ 'id' => $grade['id'] ?? null ],
                        [
                            'grading_system_id' => $gradingSystem->id,
                            'name' => $grade['name'],
                            'order' => $loopIndex
                        ]
                    );
                    $grade_ids[] = $gradingGrade->id;
                }
                // Delete any grades that were not included in the request.
                GradingGrade::whereNotIn('id', $grade_ids)->delete();
            }

            return $gradingSystem;
        });
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
