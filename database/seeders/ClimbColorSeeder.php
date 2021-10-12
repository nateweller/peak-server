<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClimbColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('climb_colors')->insert([
            'name' => 'Red',
            'color' => '#EF4444'
        ]);
        
        DB::table('climb_colors')->insert([
            'name' => 'Orange',
            'color' => '500'
        ]);
        
        DB::table('climb_colors')->insert([
            'name' => 'Yellow',
            'color' => '#FBBF24'
        ]);

        DB::table('climb_colors')->insert([
            'name' => 'Green',
            'color' => '#10B981'
        ]);

        DB::table('climb_colors')->insert([
            'name' => 'Blue',
            'color' => '#3B82F6'
        ]);

        DB::table('climb_colors')->insert([
            'name' => 'Purple',
            'color' => '#8B5CF6'
        ]);

        DB::table('climb_colors')->insert([
            'name' => 'Black',
            'color' => '#000000'
        ]);

        DB::table('climb_colors')->insert([
            'name' => 'White',
            'color' => '#FFFFFF'
        ]);
    }
}
