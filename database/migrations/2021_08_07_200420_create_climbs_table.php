<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClimbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('climbs', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('wall_id')->nullable()->constrained('walls');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('grade_id')->nullable()->constrained('grading_grades');
            $table->foreignId('color_id')->nullable()->constrained('climb_colors');
            
            $table->string('name');
            $table->string('discipline');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('climbs');
    }
}
