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
            $table->string('title_schedule');
            $table->string('lecturer');
            $table->string('description');
            $table->dateTime('schedule_start_datetime');
            $table->dateTime('schedule_end_datetime');
            $table->enum('status', ['active', 'inactive'])->default('active');
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
