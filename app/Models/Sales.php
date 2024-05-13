<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CheckUnit;
use App\Models\CarUnit;
use App\Models\User;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'check_unit_id',
        'user_id',
        'car_unit_id',
        'customer_name',
        'customer_phone',
        'payment_method',
        'date',
        'last_edit_by',
    ];

    public function checkUnit()
    {
        return $this->belongsTo(CheckUnit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carUnit()
    {
        return $this->belongsTo(CarUnit::class);
    }

    public function lastEditBy()
    {
        return $this->belongsTo(User::class, 'last_edit_by');
    }
}
