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
        Schema::create('reschedule_class', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('booking_class')->onDelete('cascade');
            $table->date('date_reschedule');
            $table->time('time_reschedule');
            $table->string('reason', length: 100);
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reschedule_class');
    }
};
