<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->insert([
            'name' => 'Test Organization'
        ]);

        DB::table('organization_user')->insert([
            'user_id' => 1,
            'organization_id' => 1
        ]);
    }
}
