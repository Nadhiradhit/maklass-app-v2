<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Add Users To User Table
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@polimedia.ac.id',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        DB::table('users')->insert([
            'name' => 'User Testing',
            'email' => 'user@polimedia.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'user'
        ]);

    }
}
