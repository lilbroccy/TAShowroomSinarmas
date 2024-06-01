<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photos;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;

class CarUnit extends Model
{
    use HasFactory;
    const FUEL_TYPE_OPTIONS = ['Diesel', 'Bensin', 'Listrik'];
    const TRANSMISSION_OPTIONS = ['Manual', 'Automatic', 'CVT', 'DCT', 'AMT'];
    protected $fillable = [
        'name',
        'price',
        'brand_id',
        'category_id',
        'user_id',
        'year',
        'fuel_type',
        'transmission',
        'seat',
        'warranty',
        'color',
        'mileage',
        'engine_cc',
        'service_book',
        'spare_key',
        'unit_document',
        'stnk_validity_period',
        'description',
        'status',
        'type',
        'type_status',
        'fee',
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    // Relasi dengan model Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Relasi dengan model Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
