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
                'room' => "L1",
                'name' => "Laboratory 1",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'room' => "L2",
                'name' => "Laboratory 2",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'room' => "L3",
                'name' => "Laboratory 3",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'room' => "L4",
                'name' => "Laboratory 4",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'room' => "L5",
                'name' => "Laboratory 5",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'room' => "L6",
                'name' => "Laboratory 6",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'room' => "L7",
                'name' => "Laboratory 7",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'room' => "L8",
                'name' => "Laboratory 8",

                'created_at' => now(),
                'updated_at' => now()
            ],
            // [
            //     'room' => "10.9",
            //     'name' => "Room 10.9",
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ],
            // [
            //     'room' => "10.10",
            //     'name' => "Room 10.10",
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ]
        ]);
    }
}
