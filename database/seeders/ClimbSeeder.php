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
            'wall_id' => 2,
            'user_id' => 1,
            'grade_id' => 1,
            'color_id' => 1,
            'name' => 'Granite',
            'discipline' => 'BOULDER',
            'created_at' => '2021-10-24 00:00:00'
        ]);

        Climb::create([
            'wall_id' => 2,
            'user_id' => 1,
            'grade_id' => 3,
            'color_id' => 3,
            'name' => 'Obsidian',
            'discipline' => 'BOULDER',
            'created_at' => '2021-10-24 00:00:00'
        ]);

        Climb::create([
            'wall_id' => 2,
            'user_id' => 1,
            'grade_id' => 7,
            'color_id' => 1,
            'name' => 'Kimberlite',
            'discipline' => 'BOULDER',
            'created_at' => '2021-10-24 00:00:00'
        ]);

        Climb::create([
            'wall_id' => 2,
            'user_id' => 1,
            'grade_id' => 7,
            'color_id' => 4,
            'name' => 'Pumice',
            'discipline' => 'BOULDER',
            'created_at' => '2021-10-24 00:00:00'
        ]);

        Climb::create([
            'wall_id' => 2,
            'user_id' => 1,
            'grade_id' => 3,
            'color_id' => 1,
            'name' => 'Basalt',
            'discipline' => 'BOULDER',
            'created_at' => '2021-10-24 00:00:00'
        ]);

        Climb::create([
            'wall_id' => 1,
            'user_id' => 1,
            'grade_id' => 1,
            'color_id' => 1,
            'name' => 'The pink one in the corner',
            'discipline' => 'BOULDER',
            'created_at' => '2021-11-01 00:00:00'
        ]);

        Climb::create([
            'wall_id' => 1,
            'user_id' => 1,
            'grade_id' => 5,
            'color_id' => 4,
            'name' => 'Midnight Lightening',
            'discipline' => 'BOULDER',
            'created_at' => '2021-11-01 00:00:00'
        ]);

        Climb::create([
            'wall_id' => 1,
            'user_id' => 1,
            'grade_id' => 2,
            'color_id' => 5,
            'name' => 'Burden of Dreams',
            'discipline' => 'BOULDER',
            'created_at' => '2021-11-01 00:00:00'
        ]);

        Climb::create([
            'wall_id' => 1,
            'user_id' => 1,
            'grade_id' => 7,
            'color_id' => 6,
            'name' => 'Evilution',
            'discipline' => 'BOULDER',
            'created_at' => '2021-11-01 00:00:00'
        ]);

        Climb::create([
            'wall_id' => 1,
            'user_id' => 1,
            'grade_id' => 3,
            'color_id' => 8,
            'name' => 'Livin\' Large',
            'discipline' => 'BOULDER',
            'created_at' => '2021-11-01 00:00:00'
        ]);
    }
}
