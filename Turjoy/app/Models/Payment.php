<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'vouchers'; //Table name within the database

   protected $fillable = [
        'id',
        'payment_method',
        'voucher_id',  
    ];

};
