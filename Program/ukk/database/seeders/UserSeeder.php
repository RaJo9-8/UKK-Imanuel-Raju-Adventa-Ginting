<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@gmail.com',
            'level' => '1', // admin
            'password' => Hash::make('admin123'),
        ]);

        // User Biasa
        User::create([
            'name' => 'User Satu',
            'email' => 'user1@gmail.com',
            'level' => '2', // user biasa
            'password' => Hash::make('user123'),
        ]);
    }
}
