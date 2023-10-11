<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $table = 'Route';

    protected $fillable = [
        'id',
        'origin',
        'destiny',
        'base_rate',
        'seat_quantity',
        'type'
    ];
}
