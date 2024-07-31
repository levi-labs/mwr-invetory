<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama' => 'Super Admin',
                'username' => 'superadmin',
                'password' => bcrypt('password'),
                'role' => 'superadmin',
                'email' => 'test@example.com',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Admin',
                'username' => 'admin',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'email' => 'test@example.com',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]

        ]);
    }
}
