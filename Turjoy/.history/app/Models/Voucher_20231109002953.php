<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'vouchers'; //Table name within the database

    protected $fillable = [
        'id',
        'travel_date',
        'origin',
        'destiny',
        'seat_quantity',
        
    ];
}
