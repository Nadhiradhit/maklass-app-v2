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
        Schema::create('room_class', function (Blueprint $table) {
            $table->id();
            $table->string('room', length: 10)->unique();
            $table->string('name', length: 20);
            $table->string('floor', length: 20);
            $table->enum('status', ['available', 'booked'])->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_class');
    }
};
