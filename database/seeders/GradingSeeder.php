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

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => 'V0',
            'order' => 0
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => 'V1',
            'order' => 1
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => 'V2',
            'order' => 2
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => 'V3',
            'order' => 3
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => 'V4',
            'order' => 4
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => 'V5',
            'order' => 5
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => 'V6',
            'order' => 6
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => 'V7',
            'order' => 7
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => 'V8',
            'order' => 8
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => 'V9',
            'order' => 9
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => 'V10',
            'order' => 10
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => 'V11',
            'order' => 11
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => 'V12',
            'order' => 12
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => 'V13',
            'order' => 13
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => 'V14',
            'order' => 14
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => 'V15',
            'order' => 15
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => 'V16',
            'order' => 16
        ]);

    }
}
