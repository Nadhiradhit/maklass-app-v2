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
                "name" => "Lab 1",
                "location" => "Gedung A, Lantai 1",
                "description" => "Laboratorium Komputer untuk kelas praktikum",
                "capacity" => 30
            ],
            [
                "name" => "Lab 2",
                "location" => "Gedung A, Lantai 1",
                "description" => "Laboratorium Fisika untuk kelas praktikum",
                "capacity" => 30
            ],
            [
                "name" => "Lab 3",
                "location" => "Gedung A, Lantai 1",
                "description" => "Laboratorium Kimia untuk kelas praktikum",
                "capacity" => 25
            ],
            [
                "name" => "Lab 4",
                "location" => "Gedung A, Lantai 2",
                "description" => "Laboratorium Biologi untuk kelas praktikum",
                "capacity" => 25
            ]
        ]);
    }
}
