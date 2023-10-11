<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'origin',
        'destination',
        'date',
        'base_rate',
        'seats',
        'time'
    ];
}
