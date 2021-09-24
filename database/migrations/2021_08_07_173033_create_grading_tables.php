<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grading_systems', function (Blueprint $table) {
            $table->id();

            $table->foreignId('organization_id')->constrained('organizations');

            $table->string('name');
            $table->string('discipline');

            $table->timestamps();
        });

        Schema::create('grading_grades', function (Blueprint $table) {
            $table->id();

            $table->foreignId('grading_system_id')->constrained('grading_systems');

            $table->string('name');
            $table->integer('order');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grading_grades');
        Schema::dropIfExists('grading_systems');
    }
}
