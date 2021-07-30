<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Organization::all();
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
            'name' => 'required|filled'
        ]);

        $organization = Organization::create([
            'name' => $request->input('name')
        ]);

        // current user owns this organization 
        $current_user_id = auth()->user()->id;
        $organization->user()->attach($current_user_id);

        return $organization;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        $organization = Organization::find($id);

        if (!$organization) {
            return response()->json([ 'message' => 'Organization not found.'], 404);
        }

        return $organization;
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
            'name' => 'filled'
        ]);

        $organization = Organization::findOrFail($id);

        if ($request->input('name')) {
            $organization->name = $request->input('name');
        }

        $organization->save();

        return $organization;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organization = Organization::find($id);

        if (!$organization) {
            return response()->json(['message' => 'Organization not found.'], 404);
        }
        
        return $organization->delete();
    }
}