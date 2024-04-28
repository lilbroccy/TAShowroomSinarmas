<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '081234567890',
            'password' => Hash::make('123'),
            'role' => 'admin', // Sesuaikan dengan role yang diinginkan, misalnya 'admin', 'owner', 'user'
        ]);

        User::create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'phone' => '089876543210',
            'password' => Hash::make('123'),
            'role' => 'owner', // Sesuaikan dengan role yang diinginkan, misalnya 'admin', 'owner', 'user'
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'phone' => '087654321098',
            'password' => Hash::make('123'),
            'role' => 'user', // Sesuaikan dengan role yang diinginkan, misalnya 'admin', 'owner', 'user'
        ]);
    }
}
