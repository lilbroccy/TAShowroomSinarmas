<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckUnit extends Model
{
    use HasFactory;
    protected $fillable = [
        'car_unit_id',
        'user_id',
        'date',
        'time',
        'status',
        'description',
    ];
}
