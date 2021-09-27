<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClimbSend;

class ClimbSendController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(ClimbSend::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ClimbSend::all();
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
            'climb_id' => 'numeric|filled|required',
            'grade_id' => 'numeric|nullable',
            'rating' => 'numeric|nullable',
            'feedback' => 'string|nullable'
        ]);

        $climbSend = ClimbSend::create([
            'climb_id' => $request->input('climb_id'),
            'user_id' => auth()->user()->id,
            'grade_id' => $request->input('grade_id'),
            'rating' => $request->input('rating'),
            'feedback' => $request->input('feedback')
        ]);

        return $climbSend;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClimbSend  $climbSend
     * @return \Illuminate\Http\Response
     */
    public function show(ClimbSend $climbSend)
    {
        return $climbSend;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClimbSend     $climbSend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClimbSend $climbSend)
    {
        $request->validate([
            'grade' => 'string|nullable',
            'rating' => 'numeric|nullable',
            'feedback' => 'string|nullable'
        ]);

        if ($request->input('grade')) {
            $climbSend->grade = $request->input('grade');
        }

        if ($request->input('rating')) {
            $climbSend->rating = $request->input('rating');
        }

        if ($request->input('feedback')) {
            $climbSend->feedback = $request->input('feedback');
        }

        $climbSend->save();

        return $climbSend;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClimbSend  $climbSend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Climb $climbSend)
    {
        return $climbSend->delete();
    }
}
