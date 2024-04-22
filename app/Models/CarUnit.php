<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Photos;
use App\Models\Brand;
use App\Models\Category;

class CarUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'brand_id',
        'category_id',
        'year',
        'fuel_type',
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
}
