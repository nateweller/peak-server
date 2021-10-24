<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{

    public function gradeSummary()
    {
        return DB::table('climbs')
                    ->leftJoin('grading_grades', 'grading_grades.id', '=', 'climbs.grade_id')
                    ->select('climbs.grade_id', 'grading_grades.name', DB::raw('count(*) as count'))
                    ->groupBy('climbs.grade_id')
                    ->get();
    }

}