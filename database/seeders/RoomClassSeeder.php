<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('room_laboratory')->insert([
            [
                'room_number' => "L1",
                'name' => "Laboratory 1",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_number' => "L2",
                'name' => "Laboratory 2",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_number' => "L3",
                'name' => "Laboratory 3",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_number' => "L4",
                'name' => "Laboratory 4",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_number' => "L5",
                'name' => "Laboratory 5",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_number' => "L6",
                'name' => "Laboratory 6",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_number' => "L7",
                'name' => "Laboratory 7",
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'room_number' => "L8",
                'name' => "Laboratory 8",
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
