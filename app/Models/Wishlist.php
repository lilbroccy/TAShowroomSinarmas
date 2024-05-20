<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable =[
    'car_unit_id',
    'user_id',
    ];
    public function carUnit()
    {
        return $this->belongsTo(CarUnit::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
