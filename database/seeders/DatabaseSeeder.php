<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\CarUnit;

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
            'address' => 'Jalan PB. Sudirman, Jember',
            'password' => Hash::make('123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'phone' => '089876543210',
            'address' => 'Jalan PB. Sudirman, Jember',
            'password' => Hash::make('123'),
            'role' => 'owner', 
        ]);

        User::create([
            'name' => 'Hendy',
            'email' => 'hendy@gmail.com',
            'phone' => '087654321098',
            'address' => 'Jalan Wolter Monginsidi, Jember',
            'password' => Hash::make('123'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Daffa Afifi',
            'email' => 'daffa@gmail.com',
            'phone' => '087654321099',
            'address' => 'Jalan Nangka, Jember',
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

        // \App\Models\CarUnit::factory()->count(20)->create();

        // for ($i = 1; $i <= 20; $i++) {
        //     DB::table('photos')->insert([
        //         'car_unit_id' => $i,
        //         'file_path' => 'car-units-photos/2024-05-1611.jpg'
        //     ]);
        // }
    }
}
