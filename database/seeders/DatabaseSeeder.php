<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@admin',
            'password' => bcrypt('admin'),
            'profile_picture' => 'https://ui-avatars.com/api/?name=Admin',
            'role' => 'admin',
        ]);
    }
}
