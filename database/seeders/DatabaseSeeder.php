<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '081234567890',
            'password' => Hash::make('123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'phone' => '089876543210',
            'password' => Hash::make('123'),
            'role' => 'owner', 
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'phone' => '087654321098',
            'password' => Hash::make('123'),
            'role' => 'user',
        ]);

        $categories = ['SUV', 'Sedan', 'Hatchback', 'MPV', 'Pick Up', 'LCGC'];

        foreach ($categories as $categoryName) {
            Category::create([
                'name' => $categoryName,
            ]);
        }

        $brands = ['Toyota', 'Mitsubishi', 'Daihatsu', 'Honda', 'Suzuki', 'Chevrolet', 'Peugeot', 'Hyundai'];

        foreach ($brands as $brandName) {
            Brand::create([
                'name' => $brandName,
            ]);
        }
    }
}
