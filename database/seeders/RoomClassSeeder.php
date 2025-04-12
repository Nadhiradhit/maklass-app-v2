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
        DB::table('room_class')->insert([
            [
                'room' => "10.1",
                'name' => "Room 10.1",
                'floor' => "Floor 10",
                'status' => "booked",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'room' => "10.2",
                'name' => "Room 10.2",
                'floor' => "Floor 10",
                'status' => "available",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'room' => "10.3",
                'name' => "Room 10.3",
                'floor' => "Floor 10",
                'status' => "booked",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'room' => "10.4",
                'name' => "Room 10.4",
                'floor' => "Floor 10",
                'status' => "available",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'room' => "10.5",
                'name' => "Room 10.5",
                'floor' => "Floor 10",
                'status' => "booked",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'room' => "10.6",
                'name' => "Room 10.6",
                'floor' => "Floor 10",
                'status' => "available",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'room' => "10.7",
                'name' => "Room 10.7",
                'floor' => "Floor 10",
                'status' => "booked",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'room' => "10.8",
                'name' => "Room 10.8",
                'floor' => "Floor 10",
                'status' => "available",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'room' => "10.9",
                'name' => "Room 10.9",
                'floor' => "Floor 10",
                'status' => "booked",
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'room' => "10.10",
                'name' => "Room 10.10",
                'floor' => "Floor 10",
                'status' => "available",
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
