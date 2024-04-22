<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarUnit;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_unit_id',
        'file_path',
        // Tambahkan atribut lain yang sesuai dengan struktur tabel photos
    ];

    public function carUnit()
    {
        return $this->belongsTo(CarUnit::class);
    }
}
