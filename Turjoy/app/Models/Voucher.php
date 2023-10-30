<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'voucher_code',
        'travel_id',
        'origin',
        'destination',
        'seats',
        'total_cost',
    ];
}
