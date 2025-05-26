<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('booking_laboratory', function (Blueprint $table) {
            $table->string('time_booking')->change();
        });
    }

    public function down()
    {
        Schema::table('booking_laboratory', function (Blueprint $table) {
            $table->time('time_booking')->change();
        });
    }
};
