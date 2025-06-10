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
        Schema::create('booking_laboratory', function (Blueprint $table) {
            $table->id();
            $table->string('booking_purpose');
            $table->string('responsible');
            $table->string('purpose');
            $table->dateTime('booking_start_datetime');
            $table->dateTime('booking_end_datetime');
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])->default('pending');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('room_laboratory_id')->constrained('room_laboratory')->onDelete('cascade');
            $table->string('file_attachment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_laboratory');
    }
};
