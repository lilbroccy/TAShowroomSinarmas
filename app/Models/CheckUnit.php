<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarUnit;
use App\Models\User;

class CheckUnit extends Model
{
    use HasFactory;
    protected $fillable = [
        'car_unit_id',
        'user_id',
        'date',
        'time',
        'status',
        'note',
        'note_from_admin',
        'last_edit_by',
    ];
    public function carUnit()
    {
        return $this->belongsTo(CarUnit::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lastEditBy()
    {
        return $this->belongsTo(User::class, 'last_edit_by');
    }
}
