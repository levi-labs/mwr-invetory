<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create();

        // \App\Models\User::factory()->create([
        //     'nama' => 'Sayuki',
        //     'username' => 'sayuki',
        //     'password' => bcrypt('password'),
        //     'role' => 'superadmin',
        //     'email' => 'test@example.com',
        //     'email_verified_at' => now(),
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}
