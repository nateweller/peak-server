<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{

    public function gradeSummary()
    {
        return DB::table('grading_grades')
                    ->leftJoin('climbs', 'climbs.grade_id', '=', 'grading_grades.id')
                    ->leftJoin('grading_systems', 'grading_grades.grading_system_id', '=', 'grading_systems.id')
                    ->select('grading_systems.discipline', 'grading_grades.id', 'grading_grades.name', DB::raw('count(climbs.grade_id) as count'))
                    ->groupBy('grading_grades.id')
                    ->get();
    }

}