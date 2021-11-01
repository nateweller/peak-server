<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ClimbSend;

class ClimbSendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClimbSend::create([
            'user_id' => 1,
            'climb_id' => 1,
            'grade_id' => 1,
            'rating' => 4,
            'feedback' => 'Classic crimpy climb!'
        ]);

        ClimbSend::create([
            'user_id' => 1,
            'climb_id' => 1,
            'grade_id' => 2,
            'rating' => 3,
            'feedback' => 'Too many crimps for my taste.'
        ]);

        ClimbSend::create([
            'user_id' => 1,
            'climb_id' => 1,
            'grade_id' => 3,
            'rating' => 2,
            'feedback' => 'Way too hard for V0!'
        ]);
    }
}
