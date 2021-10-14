<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Climb;

class ClimbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Climb::create([
            'wall_id' => 1,
            'user_id' => 1,
            'grade_id' => 1,
            'color_id' => 1,
            'name' => 'The pink one in the corner',
            'discipline' => 'BOULDER'
        ]);

        Climb::create([
            'wall_id' => 1,
            'user_id' => 1,
            'grade_id' => 5,
            'color_id' => 3,
            'name' => 'Midnight Lightening',
            'discipline' => 'BOULDER'
        ]);

        Climb::create([
            'wall_id' => 1,
            'user_id' => 1,
            'grade_id' => 2,
            'color_id' => 7,
            'name' => 'Burden of Dreams',
            'discipline' => 'BOULDER'
        ]);

        Climb::create([
            'wall_id' => 1,
            'user_id' => 1,
            'grade_id' => 7,
            'color_id' => 4,
            'name' => 'Evilution',
            'discipline' => 'BOULDER'
        ]);

        Climb::create([
            'wall_id' => 1,
            'user_id' => 1,
            'grade_id' => 3,
            'color_id' => 1,
            'name' => 'Livin\' Large',
            'discipline' => 'BOULDER'
        ]);
    }
}