<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Climb;
use Illuminate\Support\Facades\DB;

class ClimbController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Climb::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $climbs = (new Climb)->newQuery();

        if ($request->has('sort')) {

            $order = 'asc';
            if (strpos($request->sort, '_') !== false) {
                $order = explode('_', $request->sort)[1];
            }

            switch ($request->sort) {
                case 'grade_asc':
                case 'grade_desc':
                    $climbs = $climbs->leftJoin('grading_grades', 'climbs.grade_id', '=', 'grading_grades.id')
                            ->orderBy('grading_grades.order', $order)
                            ->select('climbs.*');
                case 'date_asc':
                case 'date_desc':
                default:
                    $climbs = $climbs->orderBy('created_at', $order);
                    break;
            }

            if ($request->discipline) {
                $climbs = $climbs->where('discipline', '=', $request->discipline);
            }
        }

        return $climbs->get();
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
            'grade_id' => 'numeric|nullable',
            'color_id' => 'numeric|nullable',
            'name' => 'required|filled',
            'discipline' => 'required|filled',
            'created_at' => 'date|filled'
        ]);

        $climb = Climb::create([
            'wall_id' => (int) $request->input('wall_id'),
            'user_id' => $request->user('api')->id,
            'grade_id' => $request->input('grade_id'),
            'color_id' => $request->input('color_id'),
            'name' => $request->input('name'),
            'discipline' => $request->input('discipline')
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
            'wall_id' => 'required|filled|numeric',
            'grade_id' => 'numeric|nullable',
            'color_id' => 'numeric|nullable',
            'name' => 'required|filled',
            'discipline' => 'required|filled',
            'created_at' => 'date|filled'
        ]);

        if ($request->input('wall_id')) {
            $climb->wall_id = (int) $request->input('wall_id');
        }

        if ($request->input('name')) {
            $climb->name = $request->input('name');
        }

        if ($request->input('grade_id')) {
            $climb->grade_id = $request->input('grade_id');
        }

        if ($request->input('color_id')) {
            $climb->color_id = $request->input('color_id');
        }
        
        if ($request->input('discipline')) {
            $climb->discipline = $request->input('discipline');
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
