<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'vouchers';
    protected $fillable = [
        'id',
        'travel_id',
        'origin',
        'destination',
        'seats',
        'total_cost',
    ];
}
