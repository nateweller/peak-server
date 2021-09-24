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
            
            $table->foreignId('location_id')->nullable()->constrained('locations');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('grade_id')->nullable()->constrained('grading_grades');
            
            $table->string('name');
            $table->string('discipline');
            $table->string('color')->nullable();
            
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
