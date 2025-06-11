<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('semesters')->insert([
            [
                'name' => 'Semester Ganjil 2024/2025',
                'start_date' => '2024-09-01',
                'end_date' => '2024-12-31',
                'is_active' => false,
            ],
            [
                'name' => 'Semester Genap 2024/2025',
                'start_date' => '2025-02-01',
                'end_date' => '2025-06-30',
                'is_active' => true,
            ],
            [
                'name' => 'Semester Ganjil 2025/2026',
                'start_date' => '2025-09-01',
                'end_date' => '2025-12-31',
                'is_active' => true,
            ],
            [
                'name' => 'Semester Genap 2025/2026',
                'start_date' => '2026-02-01',
                'end_date' => '2025-06-30',
                'is_active' => true,
            ],
            [
                'name' => 'Semester Ganjil 2026/2027',
                'start_date' => '2026-09-01',
                'end_date' => '2026-12-31',
                'is_active' => true,
            ],
            [
                'name' => 'Semester Genap 2026/2027',
                'start_date' => '2027-02-01',
                'end_date' => '2027-06-30',
                'is_active' => true,
            ],
            [
                'name' => 'Semester Ganjil 2027/2028',
                'start_date' => '2027-09-01',
                'end_date' => '2027-12-31',
                'is_active' => true,
            ],
            [
                'name' => 'Semester Genap 2027/2028',
                'start_date' => '2028-02-01',
                'end_date' => '2028-06-30',
                'is_active' => true,
            ],
            [
                'name' => 'Semester Ganjil 2028/2029',
                'start_date' => '2028-09-01',
                'end_date' => '2028-12-31',
                'is_active' => true,
            ],
            [
                'name' => 'Semester Genap 2028/2029',
                'start_date' => '2029-02-01',
                'end_date' => '2029-06-30',
                'is_active' => true,
            ],
            [
                'name' => 'Semester Ganjil 2029/2030',
                'start_date' => '2029-09-01',
                'end_date' => '2029-12-31',
                'is_active' => true,
            ],
            [
                'name' => 'Semester Genap 2029/2030',
                'start_date' => '2030-02-01',
                'end_date' => '2030-06-30',
                'is_active' => true,
            ],
        ]);
    }
}
