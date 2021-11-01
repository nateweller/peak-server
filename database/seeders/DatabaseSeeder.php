<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            OrganizationSeeder::class,
            LocationSeeder::class,
            WallSeeder::class,
            SetSeeder::class,
            ClimbColorSeeder::class,
            GradingSeeder::class,
            ClimbSeeder::class,
            ClimbSendSeeder::class
        ]);
    }
}
