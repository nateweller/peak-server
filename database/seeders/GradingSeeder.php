<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grading_systems')->insert([
            'organization_id' => 1,
            'name' => 'Bouldering',
            'discipline' => 'BOULDER'
        ]);

        DB::table('grading_systems')->insert([
            'organization_id' => 1,
            'name' => 'Lead',
            'discipline' => 'LEAD'
        ]);

        DB::table('grading_systems')->insert([
            'organization_id' => 1,
            'name' => 'Top Rope',
            'discipline' => 'TOP_ROPE'
        ]);

        $v_grades = ['V0', 'V1', 'V2', 'V3', 'V4', 'V5', 'V6', 'V7', 'V8', 'V9', 'V10', 'V11', 'V12', 'V13', 'V14', 'V15', 'V16'];
        foreach ($v_grades as $loopIndex => $grade) {
            DB::table('grading_grades')->insert([
                'grading_system_id' => 1,
                'name' => $grade,
                'order' => $loopIndex
            ]);
        }

        $sport_grades = [
            '5.5', '5.6', '5.7', '5.8', '5.9', 
            '5.10a', '5.10b', '5.10c', '5.10d', 
            '5.11a', '5.11b', '5.11c', '5.11d', 
            '5.12a', '5.12b', '5.12c', '5.12d', 
            '5.13a', '5.13b', '5.13c', '5.13d', 
            '5.14a', '5.14b', '5.14c', '5.14d', 
            '5.15a', '5.15b', '5.15c', '5.15d', 
            '5.16a', '5.16b', '5.16c', '5.16d'
        ];
        foreach ($sport_grades as $loopIndex => $grade) {
            DB::table('grading_grades')->insert([
                'grading_system_id' => 2,
                'name' => $grade,
                'order' => $loopIndex
            ]);

            DB::table('grading_grades')->insert([
                'grading_system_id' => 3,
                'name' => $grade,
                'order' => $loopIndex
            ]);
        }

    }
}
