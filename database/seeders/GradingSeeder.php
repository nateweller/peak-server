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
            'name' => '1',
            'order' => 0
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => '2',
            'order' => 1
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => '3',
            'order' => 2
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => '4',
            'order' => 3
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => '5',
            'order' => 4
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => '6',
            'order' => 5
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => '7',
            'order' => 6
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => '8',
            'order' => 7
        ]);

        DB::table('grading_grades')->insert([
            'grading_system_id' => 1,
            'name' => 'Feature',
            'order' => 8
        ]);

    }
}
