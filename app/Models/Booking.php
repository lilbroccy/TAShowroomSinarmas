<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarUnit;
use App\Models\User;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_unit_id',
        'user_id',
        'date',
        'payment',
    ];

    // Relasi dengan model CarUnit
    public function carUnit()
    {
        return $this->belongsTo(CarUnit::class);
    }

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
