<?php

namespace Database\Factories;

use App\Models\CarUnit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CarUnitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CarUnit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word . ' ' . $this->faker->randomElement(['SUV', 'Sedan', 'Hatchback', 'MPV', 'Pick Up', 'LCGC']),
            'price' => $this->faker->numberBetween(50000000, 300000000),
            'brand_id' => $this->faker->numberBetween(1, 8), // Ubah batas ini sesuai dengan jumlah merek yang Anda buat
            'category_id' => $this->faker->numberBetween(1, 6), // Ubah batas ini sesuai dengan jumlah kategori yang Anda buat
            'year' => $this->faker->numberBetween(2010, 2022),
            'fuel_type' => $this->faker->randomElement(['Diesel', 'Bensin', 'Listrik']),
            'transmission' => $this->faker->randomElement(['Manual', 'Automatic', 'CVT', 'DCT', 'AMT']),
            'seat' => $this->faker->numberBetween(2, 8),
            'warranty' => $this->faker->randomElement(['1 Tahun', '2 Tahun', '3 Tahun']),
            'color' => $this->faker->colorName,
            'mileage' => $this->faker->numberBetween(10000, 100000),
            'engine_cc' => $this->faker->numberBetween(1000, 4000),
            'service_book' => $this->faker->boolean,
            'spare_key' => $this->faker->boolean,
            'unit_document' => $this->faker->boolean,
            'stnk_validity_period' => $this->faker->randomElement(['1 Tahun', '2 Tahun', '3 Tahun']),
            'description' => $this->faker->paragraph,
            'status' => 'Tersedia',
        ];
    }
}



