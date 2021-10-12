<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('walls')->insert([
            'location_id' => 1,
            'name' => 'Slab',
            'order' => 0
        ]);

        DB::table('walls')->insert([
            'location_id' => 1,
            'name' => 'Overhang',
            'order' => 1
        ]);

        DB::table('walls')->insert([
            'location_id' => 1,
            'name' => 'Cave',
            'order' => 2
        ]);

        DB::table('walls')->insert([
            'location_id' => 1,
            'name' => 'Fill Wall',
            'order' => 3
        ]);
    }
}
