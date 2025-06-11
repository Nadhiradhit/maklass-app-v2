<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedule_room', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_laboratory_id')->constrained('room_laboratory')->onDelete('cascade');
            $table->foreignId('semester_id')->constrained('semesters')->onDelete('cascade');
            $table->string('title_schedule');
            $table->string('lecturer_name');
            $table->string('description');
            $table->string('schedule_day_of_week');
            $table->time('schedule_start_time');
            $table->time('schedule_end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_room');
    }
};
